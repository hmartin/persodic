
app.service('dictionaryService', function () {
    var dictionary;

    this.set = function (dic) {
        dictionary = dic;
    };
    this.get = function () {
        return dictionary;
    };
})
.service('testService', function ($http, $location) {
    this.words = {};
    this.nbQuestion = 0;
        this.id = 0;

    this.createTest = function (id, question) {
        this.nbQuestion = question;
        $http.post(API_URL + 'creates/tests.json', {id: id, nbQuestion: question})
            .success(function (data) {
                this.words = data.words;
                this.id = data.id;
                $location.path('/questions');
            }.bind(this));
    }
    this.saveResults = function (points) {
        $http.post(API_URL + 'saves/results.json', {id: this.id, points:points})
            .success(function (data) {
                this.globalScore = data.globalScore;
            }.bind(this));
    }
})

.service('wordRetriever', function () {
    
    this.getWords = function (typed) {      
        $http.post(API_URL + 'get/tests.json', {'typed':typed}).success(function (data) {
                return data.words;
            });
    };
})

.service('dicService', function ($http, $location, $cookies) {

        this.create = function (originLang, destLang) {
            $http.post(API_URL + 'creates/dics.json', {uid:$cookies.uid, originLang: originLang, destLang:destLang}).success(function (data) {
                if (data.dic) {
                    $cookies.dic = angular.toJson(data.dic);
                    $location.path('/addWord/' + data.dic.id);
                }
            });
        };
        this.get = function (id) {
            $http.post(API_URL + 'gets/dics.json', {id:id}).success(function (data) {
                if (data.dic) {
                    $cookies.dic = angular.toJson(data.dic);
                    return data.dic;
                }
            });
        };
});