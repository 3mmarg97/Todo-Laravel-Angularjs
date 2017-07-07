app.controller('tasksCtrl', function ($scope, tasksService) {
    $scope.tasks = [];
    $scope.additionError = false;

     tasksService.get().then(function (data) {
         $scope.tasks = data.data.reverse();
     });


    $scope.addTask = function () {
        tasksService.add($scope.newTask).then(function (response) {
            if (response)
                $scope.tasks = response.data.reverse();
        }, function () {
                $scope.additionError = true;
        });

        $scope.newTask = '';


    };

    $scope.changeState = function (id, index, state) {
        tasksService.updateState(id, state);
        $scope.tasks[index].state = state;
    };

    $scope.deleteSelected = function () {
        tasksService.deleteTasks();

        for (var i = 0 ; i < $scope.tasks.length ;++i)
            if ($scope.tasks[i].state){
                $scope.tasks.splice(i, 1);
                i--
            }

    };

    $scope.editTask = function (id, name, index) {
    $scope.errors = []

    tasksService.updateName(id, name).then(function (response) {
            $scope.tasks[index].name = name;
            $scope.errors[index] = false;
        }, function (response) {
            $scope.errors[index] = true;
        })


    }



});