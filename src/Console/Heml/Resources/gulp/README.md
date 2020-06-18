# dry-helpers

Don't forget to update your watch-task and main-gulpfile.




Add your heml-path to your files-path:
```
    hemlPath: 'assets/heml/**/*'
```

Add hemlTask to your watchTask:
```
    const {hemlTask} = require('./heml.js'); // don't forget require at top
    
    watch(files.hemlPath, watchOptions, hemlTask);
```

And add hemlTask to your buildTask:
```
    exports.build = series(parallel(cssTask, jsTask), faviconsTask, imgTask, hemlTask);
```
