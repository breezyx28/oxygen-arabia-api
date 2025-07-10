#!/bin/bash

# ====== CONFIGURE THESE ======
REMOTE_USER="oxygenarabia"
REMOTE_HOST="oxygenarabia.com"
REMOTE_PATH="public_html/oxygenarabia-api"
SSH_PORT=22
PASSWORD="MSActs@1981"
PLINK_PATH="/c/Program Files/PuTTY/plink.exe"  # Adjust as needed
# =============================

# Combine all remote commands in one line using &&
REMOTE_COMMANDS="
cd $REMOTE_PATH && \
git reset --hard HEAD && \
git pull origin master && \
cp .env.production .env && \
php artisan config:clear && \
php artisan cache:clear && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan migrate --force
"

# Run the command with plink and password
"$PLINK_PATH" -ssh -P $SSH_PORT -pw "$PASSWORD" ${REMOTE_USER}@${REMOTE_HOST} "$REMOTE_COMMANDS"
