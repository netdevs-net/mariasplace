# mariasplace

## Development Setup

### FTP Connection
FTP connection details are stored in `.secrets` file (gitignored for security).

**Quick Reference:**
- Host: `txpro1.fcomet.com`
- Port: `21`
- Username: `mp@mariasplace.com`
- Password: See `.secrets` file

**Connect via FTP:**
```bash
lftp -u 'mp@mariasplace.com','PASSWORD' -p 21 txpro1.fcomet.com
```

### Repository
- **GitHub**: https://github.com/netdevs-net/mariasplace
- **Current Branch**: `live`
- **Live Site Theme**: `wp-content/themes/MariasPlace/`

### Notes
- FTP credentials are stored in `.secrets` file (gitignored)
- Live site is a WordPress installation