import Vue from "vue";
import axios from "axios";

let website_queries = {
    weather: `query weather($weather: InputFields){
        weather(weather:$weather){
            error,
            message,
            _weather_data{
                weather,
                main
            }
        }
    }`,
    location: `query location($location: InputFields){
        location(location:$location){
            error,
            message,
            _location_data{
                name,
                categories,
                location
            }
        }
    }`,
};

let queries = ["weather"];

function getURL(queryName) {
    let segment = "";
    if (queries.some((variable) => variable === queryName)) {
        segment = "";
    }
    return `/graphql${segment}`;
}

Vue.prototype.$query_request = function (queryName, queryVariables) {
    let options = {
        url: getURL(queryName),
        method: "POST",
        data: {
            query: website_queries[queryName],
        },
    };

    if (queryVariables) {
        options.data.variables = queryVariables;
    }

    return axios(options);
};
