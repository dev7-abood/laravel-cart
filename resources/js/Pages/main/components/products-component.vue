<template>
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Products</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="" data-filter="*">All</li>
                            <li v-for="catOfProduct in catOfProducts" :key="catOfProduct.id" :data-filter="'.'+catOfProduct.slug_cat_name" class="">{{catOfProduct.cat_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="featured__filter" id="MixItUp127867" style="">
                <div v-for="catOfProduct in catOfProducts" :key="catOfProduct.id" :class="`row mix ${catOfProduct.slug_cat_name}`" style="">
                    <div v-for="product in catOfProduct.products" class="col-lg-3">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" :data-setbg="product.image"
                                 :style="`background-image: url(${product.image});`">
                                <ul class="featured__item__pic__hover">
                                    <li><a><i class="fa fa-heart"></i></a></li>
                                    <li><a><i class="fa fa-retweet"></i></a></li>
                                    <li><a style="cursor: pointer" @click="addItemToLocalStorage(event, product)"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{product.name}}</a></h6>
                                <h5>${{product.price}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import {ref} from 'Vue'
import swal from 'sweetalert2';
export default {
    name: "products-component",
    props :['catOfProducts'],
    setup(props){
       let product_ids = ref([]).value;
       const addItemToLocalStorage = (e, product) => {
           swal.fire({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               icon: 'success',
               title: 'Product add to cart successfully'
           });
          product_ids.push(product.id)
          let localIds = window.localStorage.getItem('product_ids') ?? []
          let unique_ids =  new Set([...product_ids, JSON.stringify(...localIds)])
          let ids = [...unique_ids];
          let numbersOnly = (val) => {
               if (typeof(val) === 'number') {
                   return val;
               }
           }
          ids = ids.filter(numbersOnly);
          window.localStorage.setItem('product_ids', `[${ids}]`)
       };

       return {addItemToLocalStorage}
    }
}
</script>

<style scoped>

</style>
