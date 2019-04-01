/**
 * Gulp file to automate the various tasks
 */
"use strict";

var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    maps = require('gulp-sourcemaps'),
    del = require('del'),
    autoprefixer = require('gulp-autoprefixer'),
    htmlreplace = require('gulp-html-replace'),
    npmDist = require('gulp-npm-dist'),
    cssmin = require('gulp-cssmin'),
    gulpCopy = require('gulp-copy'),
    connect = require('gulp-connect'),
    gulpSequence = require('gulp-sequence'),
    htmlmin = require('gulp-htmlmin');

const paths = {
    src: {
        scss: {
            app: "public/greeva/scss/app.scss",
            all: "public/greeva/scss/**/*.scss"
        },
        js: {
            all: "public/greeva/js/**"

        },
        html: {
            root: "html",
            all: "html/*.html"
        },
        assets: {
            images: "assets/images/**",
            fonts: "assets/fonts/**",
        }
    },
    dist: {
        root: "public/greeva/dist",
        all: 'public/greeva/dist/**/*',
        libs: {
            root: "./public/greeva/dist/libs"
        },
        assets: {
            root: "./public/greeva/dist/assets/"
        },
        js: {
            root: "./public/greeva/dist/js",
        },
        css: {
            root: "public/greeva/dist/css",
            app: "public/greeva/dist/css/app.css",
            app_minify: "public/greeva/css/app.min.css",
            app_minify_file_name: "app.min.css"
        },
    }
};

gulp.task('compileSass', function () {
    return gulp.src(paths.src.scss.app)
        .pipe(maps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(maps.write('./'))
        .pipe(gulp.dest(paths.dist.css.root));
});

gulp.task("minifyCss", ["compileSass"], function () {
    return gulp.src(paths.dist.css.app)
        .pipe(cssmin())
        .pipe(rename(paths.dist.css.app_minify_file_name))
        .pipe(gulp.dest(paths.dist.css.root))
        .pipe(connect.reload());
});


gulp.task('clean', function () {
    return del.sync(paths.dist.all, { force: true });
});

gulp.task('renameSources', function () {
    return gulp.src([paths.src.html.all])
        .pipe(htmlreplace({
            'css': paths.dist.css.app_minify
        }))
        .pipe(gulp.dest(paths.dist.root))
        .pipe(connect.reload());
});

gulp.task('copyLibs', function () {
    return gulp.src(npmDist(), { base: './node_modules/' })
        .pipe(rename(function (path) {
            path.dirname = path.dirname.replace(/\/dist/, '').replace(/\\dist/, '');
        }))
        .pipe(gulp.dest(paths.dist.libs.root));
});

gulp.task('copyHtml', function () {
    return gulp.src(paths.src.html.all)
        .pipe(gulp.dest(paths.dist.root))
        .pipe(connect.reload());
});

gulp.task('copyJs', function () {
    return gulp.src([paths.src.js.all])
        .pipe(gulp.dest(paths.dist.js.root))
        .pipe(connect.reload());
});


gulp.task('renameSourcesCompress', function () {
    return gulp.src([paths.src.html.all])
        .pipe(htmlreplace({
            'css': paths.dist.css.app_minify
        }))
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(paths.dist.root))
        .pipe(connect.reload());
});

gulp.task('copyHtmlCompress', function () {
    return gulp.src(paths.src.html.all)
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(paths.dist.root))
        .pipe(connect.reload());
});

gulp.task('copyJsCompress', function () {
    return gulp.src([paths.src.js.all])
        .pipe(uglify())
        .pipe(gulp.dest(paths.dist.js.root))
        .pipe(connect.reload());
});

gulp.task('copyAssets', function () {
    return gulp.src([paths.src.assets.images, paths.src.assets.fonts], { base: './src/assets' })
        .pipe(gulp.dest(paths.dist.assets.root));
});


gulp.task('connect', function () {
    connect.server({
        root: paths.dist.root,
        livereload: true,
        middleware: function(connect, opt) {
            return [
                function(req, res, next){
                    // treat POST request like GET during dev
                    req.method = 'GET';
                    return next();
                }
            ];
        }
    });
});

gulp.task("build", gulpSequence('clean', 'copyAssets', 'copyJs', ['copyHtml', 'copyLibs'], 'minifyCss', 'renameSources'));
gulp.task("build-compress", gulpSequence('clean', 'copyAssets', 'copyJsCompress', 'copyHtmlCompress', 'copyLibs', 'minifyCss', 'renameSourcesCompress'));

gulp.task('watch', ['build'], function () {
    gulp.watch(paths.src.scss.all, ['minifyCss']);
    gulp.watch(paths.src.html.all, ['copyHtml']);
    gulp.watch(paths.src.js.all, ['copyJs']);
});

gulp.task("default", ["connect", 'watch']);

gulp.task('doc', function () {
    connect.server({
        root: 'docs'
    });
});