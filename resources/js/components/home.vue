<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body" v-for="(hotel,index) in hotels.data" :key="index">
                        <div class="media">
                            <img class="mr-3" width="170" height="144" :src="'/images/hotels/'+hotel.image_id" alt="Generic placeholder image">
                            <div class="media-body">
                                <router-link :to="'/hotel/test/23'">
                                    <h5 class="mt-0">{{hotel.name}}</h5>
                                </router-link>
                                <p>
                                    <span class="text-default">{{hotel.city}},{{hotel.countryfull}}</span>
                                    <span class="text-danger">{{hotel.added}}</span>
                                </p>
                                {{hotel.shortdesc}}
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
       data(){
           return {
               hotels:{}
           }
           
       },
       created(){
           this.getHotels();
       },
       methods:{
           getHotels(){
              axios.get('/api/testapix').then(response=>{
                  console.log(response.data);
                  this.hotels=response.data;
              });
           }
       }
    }
</script>
