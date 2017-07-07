app.factory('tasksService', function ($http, $cookies) {
    return {
        get: function () {
            return $http.get('/api/');
        },

        add: function (task) {
            return  $http( {
                method: 'POST',
                url: '/api',
                headers: {
                'X-XSRF-TOKEN': $cookies.get('XSRF-TOKEN')
            },
            data: { task: task }
        }
    );
        },

        updateState: function (id, state) {
            return $http({
                method: 'POST',
                url: '/api/' + id + '/' + state,
                headers: {
                    'X-XSRF-TOKEN': $cookies.get('XSRF-TOKEN')
                }
            })
        },

        updateName: function (id, name) {
            return $http({
                method: 'POST',
                url: '/api/edit/' + id + '/' + name,
                headers: {
                    'X-XSRF-TOKEN': $cookies.get('XSRF-TOKEN')
                }
            })
        },

        deleteTasks: function () {
            return $http({
                method: 'DELETE',
                url: '/api/',
                headers: {
                    'X-XSRF-TOKEN': $cookies.get('XSRF-TOKEN'),
                }
            })
        }

    }
});