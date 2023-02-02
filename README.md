# Private photo gallery

A small php website to showcase private photos.

- Dependencies: Composer, see /lib/composer/composer.json and Parsedown, see [Github](https://github.com/erusev/parsedown)
- .htaccess for access control
- Layout: Bootstrap
- For usage:   
  - Create /categories.php, consisting of an array `$categories`, containing an array of pages per group in .htaccess
  - For each page: Create `/content/page_title` and `/content/_preview/page_title`
  - For `content/page_title`: 
    - Add `index.php` including `/content/_base/index.php`
    - Add `content.md` with the content of the page
    - Add `metadata.php` with the metadata `$TITLE` and `$TITLEIMG`
    - Add `.htaccess` if you want
  - For `/content/_preview/page_title`:
    - Add preview image referenced in `$TITLEIMG` of `metadata.php`
