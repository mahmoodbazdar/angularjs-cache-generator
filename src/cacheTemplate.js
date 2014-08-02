angular.module("{{FILE-PATH}}", []).run(["$templateCache", function ($templateCache) {
    $templateCache.put("{{FILE-PATH}}",
        "{{FILE-DATA}}"
    );
}]);