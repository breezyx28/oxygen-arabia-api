#!/bin/bash

# ====== CONFIGURE THESE ======
REMOTE_USER="oxygenarabia"
REMOTE_HOST="oxygenarabia.com"
REMOTE_PATH="public_html/oxygenarabia-api"
SSH_PORT=22
PASSWORD="MSActs@1981"
PLINK_PATH="/c/Program Files/PuTTY/plink.exe"  # Adjust path if needed
# =============================

# Create a temporary command file
COMMANDS_FILE=$(mktemp)

# Add the remote commands
cat <<EOF > "$COMMANDS_FILE"
cd $REMOTE_PATH
git pull origin master
cp .env.production .env
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
EOF

# Run the commands using plink with password authentication
"$PLINK_PATH" -ssh -P $SSH_PORT -pw "$PASSWORD" ${REMOTE_USER}@${REMOTE_HOST} < "$COMMANDS_FILE"

# Clean up
rm "$COMMANDS_FILE"
