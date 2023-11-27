<template>
    <div class="container-fluid px-0 app">
        <!-- <router-view></router-view> -->
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-12">
                    <div class="card d-flex flex-column h-100 card-bg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2">
                                    <div class="card h-100 card-1st-child">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="search" class="form-control textbox" @keyup.enter="onReload" @input="onClearError" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary search" @click="onReload">Search</button>
                                                </div>
                                            </div>

                                            <p class="text-white bg-danger">{{ search_error }}</p>
                                            <div v-if="is_loading_weather" class="text-center d-flex justify-content-center h-100">
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>

                                            <div v-else class="text-center d-flex justify-content-center align-items-lg-center">
                                                <div class="d-inline-block">
                                                    <img class="img-fluid" v-if="icon !== ''" :src="'public/images/icons/' + icon + '.png'" alt="" />
                                                    <h4 class="text-white">{{ temperature }} °C</h4>
                                                    <p class="text-capitalize text-white">{{ weather }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">
                                    <div class="card h-100 card-2nd-child">
                                        <div class="card-body">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="search_place" :placeholder="'Search places within ' + search" class="form-control textbox" @keyup.enter="getCurrentLocation" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary search" @click="getCurrentLocation">Search</button>
                                                </div>
                                            </div>

                                            <div v-if="available_places.length <= 0 && is_loading_places == false" class="text-center d-flex-justify-content-center h-100">
                                                <p>No currently opened places found.</p>
                                            </div>
                                            <span v-else>
                                                <div v-if="is_loading_places" class="text-center d-flex justify-content-center">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                                <div v-else class="table-responsive" style="max-height: 200px; overflow: auto">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Address</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(place, index) in available_places" :key="index">
                                                                <th scope="row" class="text-capitalize">{{ place.name }}</th>
                                                                <td>{{ place.location.formatted_address }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            is_loading_weather: false,
            is_loading_places: true,
            search: "Tokyo",
            search_error: "",
            temperature: 0,
            weather: "",
            icon: "",
            search_place: "",
            available_places: [],
        };
    },
    created() {
        this.onReload();
    },
    methods: {
        onClearError() {
            this.search_error = "";
        },
        onReload() {
            this.getCurrentWeather();
            this.getCurrentLocation();
        },
        getCurrentWeather() {
            this.is_loading_weather = true;
            this.$query_request("weather", {
                weather: {
                    action_type: "get_weather",
                    destination: this.search.toString(),
                },
            })
                .then((res) => {
                    this.is_loading_weather = false;
                    let response = res.data.data.weather;
                    if (response.error == false) {
                        let totalTemp = parseFloat(response._weather_data.main.temp) - 273.15;
                        this.temperature = totalTemp.toFixed(2);
                        this.weather = response._weather_data.weather[0].description;
                        this.icon = response._weather_data.weather[0].icon;
                    } else {
                    }
                })
                .catch((error) => {
                    this.is_loading_weather = false;
                });
        },
        getCurrentLocation() {
            if (this.search != "") {
                this.is_loading_places = true;
                this.$query_request("location", {
                    location: {
                        action_type: "get_location",
                        destination: this.search.toString(),
                        category: "",
                        place_search: this.search_place.toString(),
                    },
                })
                    .then((res) => {
                        this.is_loading_places = false;
                        let response = res.data.data.location;
                        if (response.error == false) {
                            this.available_places = response._location_data;
                        } else {
                            this.available_places = [];
                        }
                    })
                    .catch((error) => {
                        this.is_loading_places = false;
                    });
            } else {
                this.search_error = "Please provide a location within Japan";
            }
        },
    },
};
</script>
