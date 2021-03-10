## Worker ##

```bash
sudo apt-get install supervisor
```

Настройки supervisor: `/etc/supervisor/conf.d`
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/dpo/dpo.ivgpu.com/artisan queue:work --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=dpo
numprocs=3
redirect_stderr=true
stdout_logfile=/var/www/dpo/worker.log
stopwaitsecs=3600
```

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```
