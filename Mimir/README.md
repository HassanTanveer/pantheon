## Mimir: game storage

![Mimir](www/mimirhires.png?raw=true "Mimir")

**Mimir** is a backend for [Tyr](https://github.com/MahjongPantheon/pantheon/tree/master/Tyr) and 
[Rheda](https://github.com/MahjongPantheon/pantheon/tree/master/Rheda), which provides storage of game 
information for japanese (riichi) mahjong sessions. 

Please use our [Bug tracker](https://pantheon.myjetbrains.com/youtrack/issues/MIMIR) for error reports
and feature requests.

### Features

We needed a simple but stateful API for gaming assistance in aspects like:
- Storing game log for an offline game.
- Automated scoring and game log sanity checking (for offline games).
- Fetching game logs from online mahjong services.
- Keeping players' gameplay history and make some interesting statistics for their games.
- Automating creating and performing of online and offline tournaments.
- And many more...

### Technologies of Mimir

- Mimir uses Twirp protocol to communicate with clients.
- PostgreSQL v12+ and PHP v8.0+ are required to run Mimir in standalone mode.
- Nginx is the recommended web server to run Mimir. See *nginx.example.conf* file for typical installation nginx config.
- [Api doc here](APIDOC.md)

### Standalone installation

- For standalone installation, run `make deps` from current folder to install all runtime dependencies.
- To configure your Mimir instance, see `config/index.php` file, you may want to alter that file, or to make use of
local overrides, as described in the file.
- Make sure you have created database and user for Mimir; if you migrated from other database, check that all tables
are owned by your database user. This is required to run migrations. Creating tables in schema other than `public` is
not supported (although may work somehow).
- Run `bin/phinx migrate -e production` to create tables in your database. It requires some `PHINX_DBPROD_*` environment
variables to be set, see phinx documentation and `phinx.yml` file for details.
- Use `opcache` module to speed up your installation. Recommended default values for opcache are:
    - `opcache.enable=1`
    - `opcache.memory_consumption=128`
    - `opcache.interned_strings_buffer=8`
    - `opcache.max_accelerated_files=4000`
    - `opcache.fast_shutdown=1`  

### Developer information

We accept any help with developing, testing and improving our system, so please feel free to create issues or send 
pull requests for missing functionality.

To start developing the project, make sure you have installed postgresql server, PHP v7.1 or higher and appropriate PDO 
module. Simpler way to start developing using Docker is described in parent folder, take a look at it.
- Use `make apidoc` from current folder to regenerate api methods documentation file.
- Remember to use PSR2 coding standards when adding php code.
- The DB migrations are implemented using [Phinx](http://docs.phinx.org), see its documentation for details.

Nginx is the recommended web server to run Mimir. See *nginx.example.com* file for typical installation nginx config.

### Versioning

Mimir uses Semver-like versioning system: *Major*.*Minor*.*Bugfix*
- Major version change occurs when breaking changes are made to the API. 
- Minor version changes when non-breaking fixes and features are implemented.  
- Bugfix version changes when one or several bug fixes are applied, and they do not change any essential system behavior.

Mimir's API protocol version matches Mimir's major and minor version: *Major*.*Minor*
- Clients should pass desired protocol version as X-Api-Version header.
- Mimir response also contains same header with current API protocol version.
- Different major versions of API are not expected to be compatible at all. Client should upgrade or downgrade to match 
API version.
- Different minor versions are expected to be forward and partially backward compatible. Client may lack some 
functionality and may not use some of response fields. But it's guaranteed that no existing functionality of any 
client within single major version could be broken.

### Legend

**Mimir** is a figure in Norse mythology renowned for his knowledge and wisdom. See wikipedia for details :)

