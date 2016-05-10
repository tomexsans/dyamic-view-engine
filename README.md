# dyamic-view-engine
For Codeigniter Load views Dynamically using the controller/method URL


##How This Works?

For Example you have a codeigniter installation with url www.domain/foo/bar

Breakdown
- foo [controller]
- bar [method]

DVE will automatically find foo/bar and load it in view.

## How to use?

- Their are many ways you can use DVE one way of doing it is by using Extending it on your controller
- set up the default template to use on *view_template* a default template is given
- we are grouping the body/[page content] so that it will be easy to locate a default *template* folder is also given

once done

- create a folder for your controller
- create a page for your method
- If you want a page to be loaded example ```registration/login```

so now our file directory structure would be

* application[dir]
 * views[dir]
   * templates[dir]
     * registration[dir]
       * login.php[file]


*to add more variables used*

