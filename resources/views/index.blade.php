<!doctype html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<title>Project</title>


	<link rel="manifest" href="/favicon/manifest.json">
	<!--<meta name="msapplication-TileColor" content="#ffffff">-->
	<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!--<meta name="theme-color" content="#ffffff">-->


	<link rel="stylesheet" href="/frontend/app/bower_components/angular-material/angular-material.css">
	<link rel="stylesheet" href="/frontend/app/bower_components/ng-table/dist/ng-table.css">
	<link rel="stylesheet" href="/frontend/app/bower_components/angular-material-data-table/dist/md-data-table.css">
	<link rel="stylesheet" href="/frontend/app/bower_components/bootstrap/dist/css/bootstrap.css">

	<link rel="stylesheet" href="/frontend/app/assets/css/main.css">
	<link rel="stylesheet" href="/frontend/app/assets/css/robotoDraft.css">

	<script src="/frontend/app/bower_components/angular/angular.js"></script>
	<script src="/frontend/app/bower_components/angular-animate/angular-animate.js"></script>
	<script src="/frontend/app/bower_components/angular-route/angular-route.js"></script>
	<script src="/frontend/app/bower_components/angular-aria/angular-aria.js"></script>
	<script src="/frontend/app/bower_components/angular-resource/angular-resource.js"></script>
	<script src="/frontend/app/bower_components/angular-material/angular-material.js"></script>
	<script src="/frontend/app/bower_components/angular-ui-router/release/angular-ui-router.js"></script>
	<script src="/frontend/app/bower_components/lodash/lodash.js"></script>
	<script src="/frontend/app/bower_components/ng-table/dist/ng-table.js"></script>
	<script src="/frontend/app/bower_components/angular-material-data-table/dist/md-data-table.js"></script>

	<script src="/frontend/app/app.module.js"></script>
	<script src="/frontend/app/app.routes.js"></script>

	<script src="/frontend/app/core/directives/focusOn.js"></script>
	<script src="/frontend/app/core/services/auth.js"></script>
	<script src="/frontend/app/core/services/users.js"></script>
	<script src="/frontend/app/core/services/companies.js"></script>

	<script src="/frontend/app/modules/calls/module.js"></script>
	<script src="/frontend/app/modules/calls/router.js"></script>
	<script src="/frontend/app/modules/calls/filters/formatDate.js"></script>
	<script src="/frontend/app/modules/calls/controllers/main.js"></script>
	<script src="/frontend/app/modules/calls/controllers/lists.js"></script>
	<script src="/frontend/app/modules/calls/controllers/filters.js"></script>
	<script src="/frontend/app/modules/calls/directives/filterType/string.js"></script>
	<script src="/frontend/app/modules/calls/directives/filterType/int.js"></script>
	<script src="/frontend/app/modules/calls/directives/filterType/date.js"></script>
	<script src="/frontend/app/modules/calls/directives/filterType/boolean.js"></script>
	<script src="/frontend/app/modules/calls/directives/filter.js"></script>
	<script src="/frontend/app/modules/calls/services/calls.js"></script>
	<script src="/frontend/app/modules/calls/services/loader.js"></script>

	<script type="text/javascript">

		//TODO autogenerate from backend
		(function( app ) {

			'use strict';

			app.constant(
					'config',
					{
						pusher: {
							appKey: 'api key pentru testse'
						},
						user: {
							id: 1
						},
						company: {
							id: 1
						}
					}
			);
			app.constant( 'API', 'http://www.project-cmb.com/api/v1' );
			app.constant( 'FRONTEND', '/frontend/' );
			phone.constant( 'FRONTEND', '/frontend/' );

		}(app));

	</script>


	<script src="/frontend/app/core/my-account/controllers/my-account.js"></script>
	<script src="/frontend/app/core/my-account/services/my-account.js"></script>
	<script src="/frontend/app/core/my-account/filters/my-account.js"></script>

</head>

<body layout="column" class="view-frame">

<div layout="row" ui-view="header"></div>
<div layout="row" flex ui-view="content"></div>
<div layout="row" ui-view="footer"></div>

</body>
</html>
