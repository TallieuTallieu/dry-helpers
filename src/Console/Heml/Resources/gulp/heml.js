"use strict";

const gulp = require('gulp');
const heml = require('gulp-heml');
const ext = require('gulp-ext-replace');
const fileinclude = require('gulp-file-include');
const replace = require('gulp-replace');

gulp.task('heml', () => {
  gulp.src('assets/heml/**/*.heml')
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
    .pipe(heml())
    .pipe(replace(
      '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />',
      '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
    ))
    .pipe(ext('.tpl'))
    .pipe(gulp.dest( 'app/templates/heml/'))
});