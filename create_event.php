<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/dist/css/blog.css" rel="stylesheet">
    <link href="/dist/css/jquery-ui.css" rel="stylesheet">
    <script src="/dist/js/lib/angular.js"></script>
  </head>

  <body ng-app="prinuk" ng-controller="createCtrl" ng-cloak>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">

          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/">PR in UK</a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
          </div>
        </div>
      </header>

    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="row form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title">
          </div>
          <div class="row form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description"></textarea>
          </div>
          <div class="row form-group">
            <label for="description">Short Description:</label>
            <textarea class="form-control" rows="5" id="short_description"></textarea>
          </div>
          <div class="row form-group">
            <label for="url">URL:</label>
            <input type="text" class="form-control" id="url">
          </div>
          <div class="row form-group">
            <label for="active">Active:</label>
            <input type="text" class="form-control" id="active">
          </div>
          <div class="row form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address">
          </div>
          <div class="row form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price">
          </div>
          <div class="row form-group">
            <label for="town">Town:</label>
            <input type="text" class="form-control" id="town">
          </div>
          <div class="row form-group">
            <label for="county">County:</label>
            <input type="text" class="form-control" id="county">
          </div>
          <form>
            <div class="form-group">
              <label for="type_select">Select event type (select one):</label>
              <select class="form-control" id="type_select">
                <option></option>
                <option ng-repeat="type in types" value="{{type.id}}">{{type.name}}</option>
              </select>
            </div>
          </form>
          <div class="row form-group">
            <label for="user">User:</label>
            <input type="text" class="form-control" id="user">
          </div>
          <div class="row form-group">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password">
          </div>
          <label for="date_pickers">Dates:</label>
          <p id="date_pickers"><input type="text" class="form-control" id="datepickerFrom"> to <input class="form-control" type="text" id="datepickerTo"></p>
          <button type="submit" class="btn btn-primary" ng-click="submit_data()">Submit</button>
        </div>
      </div>
    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/dist/js/lib/jquery-ui.js"></script>
    <script src="/dist/js/lib/popper.min.js"></script>
    <script src="/dist/js/lib/bootstrap.min.js"></script>
    <script src="/dist/js/lib/holder.min.js"></script>
    <script src="/dist/js/create_event.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
