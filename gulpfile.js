'use strict';

// что нужно для работы
var gulp = require('gulp');
var less = require('gulp-less');
var cssmin = require('gulp-cssmin');
var prefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var rimraf = require('rimraf');
var rigger = require('gulp-rigger');
var newer =  require('gulp-newer');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var browserSync = require("browser-sync").create();
var reload = browserSync.reload;
var notify = require('gulp-notify');
var uglify = require('gulp-uglify');
var browserify = require('browserify');
var babelify   = require('babelify');
var buffer = require('vinyl-buffer');
var source = require('vinyl-source-stream');

var path = {
    source: {
        js: 'frontend/source/js/main.js',
        styles: 'frontend/source/less/style.less',
        images: 'frontend/source/images/**/*.*' //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
    },
    web: {
        js: 'frontend/web/js/',
        styles: 'frontend/web/css/',
        images: 'frontend/web/images/'
    },
    //clean: './public',
    watch: { // за чем наблюдаем
        js: 'frontend/source/js/**/*.js',
        styles: 'frontend/source/less/**/**/*.less',
        images: 'frontend/source/images/**/*.*',
        php: 'frontend/views/**/*.php'
    }
};

// конфиг сервера
var config = {
    /*server: {
        baseDir: "/var/www/yii2.loc/frontend/web"
    },*/
    //tunnel: true,
    //host: 'localhost',
    proxy:'yii2.loc',
    port: 9000,
    logPrefix: "Yii2 project",
    notify: false
};

//css
gulp.task('css', function () {
    return gulp.src(path.source.styles) // берем препроцессорный код
        .pipe(less()) // преобразуем в css
        .on('error', notify.onError(function(err){ // обрабатываем ошибки
            return {
                title: 'Styles compilation error',
                message: err.message
            }
        }))
        .pipe(prefixer()) // добавляем префиксы
        .pipe(cssmin()) // сжимаем когда на прод
        .pipe(rename("style.min.css")) // переименовываем когда на прод
        .pipe(gulp.dest(path.web.styles)) // и пишем в public
        .pipe(reload({stream: true})); // перезагрузим сервер
});

//js
gulp.task('js', function () {
    gulp.src(path.source.js) //Найдем наш main файл
        .pipe(rigger()) //Прогоним через rigger склеим все в один файл
        .on('error', notify.onError(function(err){ // обрабатываем ошибки
            return {
                title: 'Js Error',
                message: err.message
            }
        }))
        .pipe(uglify()) //Сожмем наш js
        .pipe(rename("main.min.js")) //Перименуем
        .pipe(gulp.dest(path.web.js)) //Выплюнем готовый файл
        .pipe(reload({stream: true})); //И перезагрузим сервер
});

//js browserify + babelify
gulp.task('js:browserify', function () {
    var browse =  browserify(path.source.js,{debug : false}).transform(babelify, { presets : [ 'es2015' ] }); // входная точка
    browse.bundle()
        .pipe(source(path.source.js))
        .pipe(buffer())
        .pipe(uglify()) //Сожмем наш js
        .pipe(rename("main.min.js"))
        .pipe(gulp.dest(path.web.js))
        .pipe(reload({stream: true}));

});
//images
gulp.task('images', function () {
    gulp.src(path.source.images)
        .pipe(newer('frontend/web/images'))
        .pipe(imagemin({ //Сожмем их
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
            interlaced: true
        }))
         // фильтр, копируем только неизмененные картинки
        .pipe(gulp.dest(path.web.images))
        .pipe(reload({stream: true})); // перезагрузим сервер
});

//наблюдение за измененными файлами если что-то изменилось то пересобираем
gulp.task('watch', function () {
    gulp.watch(path.watch.styles, ['css']);
    //gulp.watch(path.watch.js, ['js']);
    //gulp.watch(path.watch.js, ['js:browserify']);
    gulp.watch(path.watch.images, ['images']);
    gulp.watch(path.watch.php,reload);
});

// browser-sinc
gulp.task('server', function () {
    browserSync.init(config);
});
// задача по умолчанию
gulp.task('default',['server', 'watch'], function() {});