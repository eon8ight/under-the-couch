#!/bin/sh

sql_dir="$(dirname $(greadlink -f $0))"

# SQL credentials
user="postgres"
db_user="gtmn"
db="gtmn"
db_temp="gtmn_temp"

# $1 = command to run
# $2 = database name (optional)
pg_cmd () {
    if [ -z $2 ]; then
        psql -w -U "$user" -c "$1"
    else
        psql -w -U "$user" -d "$2" -c "$1"
    fi
}

# $1 = file to run
# $2 = database name
pg_file () {
    psql -w -U "$user" -d "$2" -f "$1" -1
}

echo "Creating new database..."
dropdb -e --if-exists -U "$user" -w "$db_temp"
createdb -e -U "$user" -w "$db_temp"

echo "\nInstalling patch metadata schema..."
pg_file "$sql_dir/data/2016-11/issue-1.patch_metadata_schema.sql" "$db_temp"
echo "\nCreating upsert function..."
pg_file "$sql_dir/functions/fn_insert_or_update_row.sql" "$db_temp"
echo "\nRunning DB patcher..."
./patch_db_osx.py -U "$user" -d "$db_temp"

echo "\nDropping old database..."
dropdb -e --if-exists -U "$user" -w "$db"

echo "\nRenaming new database..."
pg_cmd "alter database $db_temp rename to $db"

echo "\nGranting permissions..."
pg_cmd "grant usage on schema public to $db_user"
pg_cmd "alter default privileges in schema public grant all on tables to $db_user"
pg_cmd "grant connect on database $db to $db_user"

pg_cmd "grant usage on schema public to $db_user" "$db"
pg_cmd "grant all on all sequences in schema public to $db_user" "$db"
pg_cmd "grant all on all tables in schema public to $db_user" "$db"

echo "\nCreating extensions..."
pg_cmd "create extension pgcrypto" "$db"

exit 0
