# SymfonyTwigExtensions
This is a collection of Twig extensions that I use in symfony.

## Grunt Asset Cache Bust
Extension when using Grunt plugin Cache Bust. See https://github.com/hollandben/grunt-cache-bust

### How to use in Symfony
In app/Resources/services.yml:

    services:
      my_app.twig.grunt_cache_bust:
        class: Treeleaf\Twig\Extension\GruntAssetCacheBust
        public: false
        tags:
            - { name: twig.extension }

In a twig template:

    <script src="/{{ gruntCacheBust('grunt-cache-bust.json', 'js/app.js') }}"></script>

### Grunt

Example Gruntfile.js:

    cacheBust: {
        options: {
            assets: ['css/*', 'js/*']
        },
        all: {
            options: {
                expand: true,
                queryString: true,
                jsonOutput: true
            },
            src: ['/js/**/*.js', '/css/**/*.css']
        }
    }

This will by default generate a json artefact *grunt-cache-bust.json* with a mapping of the source file and the hashed file.

Example grunt-cache-bust.json:

    {
        "js/vendor.js":"js/vendor.js?82f8fc4bb7e495e6",
        "js/app.js":"js/app.js?4df6c65674ecfa3d",
        "css/main.css":"css/main.css?362da3994e41aa48"
    }