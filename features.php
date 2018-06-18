<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Events & Me Create Event Page</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dist/css/fonts.css" rel="stylesheet">
    <link href="/dist/css/blog.css" rel="stylesheet">
    <link href="/dist/css/jquery-ui.css" rel="stylesheet">
  </head>

  <body ng-app="prinuk" ng-controller="featuresCtrl" class="background-pattern" ng-cloak>

    <div class="container" ng-cloak style="background-color:white; box-shadow: 10px 10px 10px black;">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-2 pt-1">

          </div>
          <div class="col-8 text-center">
            <a class="blog-header-logo text-dark" href="/">Events & Me</a>
          </div>
          <div class="col-2 d-flex justify-content-end align-items-center">
            <!-- <div class="search-container">
              <form>
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>-->
          </div>
        </div>
      </header>
    </div>

    <main role="main" class="container" style="background-color:white; box-shadow: 10px 10px 10px black; padding-top:15px">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="row form-group">
            <label for="user">User:</label>
            <input type="text" class="form-control" id="user">
          </div>
          <div class="row form-group">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password">
          </div>
          <form ng-repeat="single_featured in featured">
            <h3>Featured {{single_featured.position}}</h3>
            <div class="form-group">
              <label for="type_select">Select event:</label>
              <select class="form-control" id="id{{single_featured.position}}" aria-label="ngSelected">
                <option ng-repeat="event in all_events" ng-selected="{{event.id==single_featured.id}}" value="{{event.id}}">{{event.event_title}}</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" ng-click="submit_data(single_featured.position)">Update</button>
          </form>
        </div>
      </div>
    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Developed by TEIA Engineering</p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="dist/js/lib/jquery.js"></script>
    <script src="/dist/js/lib/jquery-ui.js"></script>
    <script src="/dist/js/lib/angular.js"></script>
    <script src="/dist/js/lib/popper.min.js"></script>
    <script src="/dist/js/lib/bootstrap.min.js"></script>
    <script src="/dist/js/lib/holder.min.js"></script>
    <script src="/dist/js/features.js"></script>
    <script src="/dist/js/lib/fontawesome.solid.js"></script>
    <script src="/dist/js/lib/fontawesome.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
