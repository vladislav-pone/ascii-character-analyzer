# ASCII character analyzer
Command line tool to find non-repeating, the least repeating, or the most repeating ASCII character in file

###Usage
`script.php -i <filename> -f <non-repeating|least-repeating|most-repeating> [-P] [-L] [-S]`

Command accepts following flags:
 * `-i, --input <file>` File path relative to script script.php (for docker must be in same directory or in subdirectory)
 * `-f, --format <format>` Format or processing algorithm. Simply - what to find. Available formats are:
   * non-repeating
   * least-repeating
   * most-repeating
 * `-L` Run search for ASCII lowercase letters `a-z` 
 * `-P` Run search for ASCII punctuation symbols `!,.?\-:`
 * `-S` Run search for ASCII symbols `0123456789"#%&'()*+/;<=>@[]^_{}`

Note: one of `-L` `-P` `-S` flags must be provided

###Examples
* `docker run -v ${PWD}:/app php:8.1-cli php /app/script.php -i example.txt -f non-repeating -P -L -S`
* `docker run -v ${PWD}:/app php:8.1-cli php /app/script.php -i example.txt -f least-repeating -P -L -S`
* `docker run -v ${PWD}:/app php:8.1-cli php /app/script.php -i example.txt -f most-repeating -P -L -S`

###Testing
`docker run -v ${PWD}:/app php:8.1-cli app/vendor/bin/phpunit app/tests`
