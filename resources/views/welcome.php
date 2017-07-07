<!DOCTYPE html>
<html dir="<?= __('main.dir') ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Todo app</title>
	<link rel="stylesheet" href="/css/style.css">
	<?php if (__('main.dir') == 'rtl') {?>
	<link rel="stylesheet" href="/css/rtl.css">
	<?php } ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-cookies.js"></script>

	<script src="/js/app.js"></script>
	<script src="/js/controllers.js"></script>
	<script src="/js/services.js"></script>
</head>
<body ng-app="TodoApp">
	<a href="<?= (App::getLocale() == 'ar')? 'en' : 'ar' ?>">
	<div id="langSelector">
	</div>
	<span class="fa fa-language fa-2x"></span>
	</a>
	<div id="mainContent">

		<table ng-controller="tasksCtrl" ng-init="getTasks()">
			<thead>
				<tr>
					<th colspan="2">
						<input id="task" type="text" ng-model="newTask"
							   ng-keyup="$event.keyCode === 13 && addTask()" ng-keydown="additionError=false"
							   ng-class="  {error: additionError}">
					</th>
					<th>
						<button ng-click="addTask()">
							<i class="fa-fw fa fa-plus" aria-hidden="true"></i>
						</button>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="task in tasks" ng-init="newState = task.state;editMode = false;newTaskName = task.name">
					<td>
						<input id="task-{{task.id}}" type="checkbox" ng-checked="task.state"
							   ng-model="newState" ng-click="changeState(task.id, $index, newState)">
					</td>

					<td class="content">
						<label for="task-{{task.id}}">
							<span ng-hide="editMode">{{ task.name }}</span>
							<input type="text" ng-show="editMode" ng-model="newTaskName">
						</label>
					</td>

					<td>
						<button ng-class="{error: errors[$index]}"
								ng-click="editMode = !editMode;!editMode? editTask(task.id, newTaskName, $index):''">
							<i class="fa-fw fa fa-pencil" aria-hidden="true" ng-hide="editMode"></i>
							<i class="fa-fw fa fa-check" aria-hidden="true" ng-show="editMode"></i>
						</button>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3">
						<input type="button" style="width: 100%;" value="<?= __('main.delete') ?>" ng-click="deleteSelected()">
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>
