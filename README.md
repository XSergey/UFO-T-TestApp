# UFO-T-TestApp
===============

Welcome! 
This is a task from UFO Engineering. I have some time to prepare installation guide for you.

Installation as a Vendor
------------
Installation


Test Component
------------
You can test component in your browser. Before you need to add Bower and Gulp dependencies.

1. Copy `repository` to your server folder.

2. You can manage all libraries for assets with `bower`:

```
npm i -g bower
bower update
```

After you can see new `bower_components` folder.

3. Install `gulp` with `npm`.

```
npm i gulp
```

4. All bower js/css files going to `gulp` pipeline from `bower_components` folder.

After you can run Gulp:
```
gulp
```

4. Now you can run the project in browser!