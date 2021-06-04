<template>
    <header-component/>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="product in products">
                                <td class="shoping__cart__item">
                                    <img :src="product.image" alt="">
                                    <h5>{{product.name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{product.price}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty"><span @click="decreaseItem(product.id, product.price)" class="dec qtybtn">-</span>
                                            <input type="text"  :value="count[`product_value_${product.id}`] ?? 1">
                                            <span @click="increaseItem(product.id, product.price)" class="inc qtybtn">+</span></div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    ${{price[`price_${product.id}`] ?? product.price}}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span @click="deleteItem(product.id)" class="icon_close"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
<!--                    <div class="shoping__cart__btns">-->
<!--                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>-->
<!--                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>-->
<!--                            Upadate Cart</a>-->
<!--                    </div>-->
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input v-model="couponCode" required type="text" placeholder="Enter your coupon code">
                                <button  @click="applyDiscount" type="button" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{afterDiscount === 0 ? total_price : afterDiscount}}</span></li>
                            <li>Total <span>${{total_price}}</span></li>
                        </ul>
                        <a style="cursor: pointer" @click="buyProduct"  class="primary-btn text-white">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import headerComponent from "../components/header-component";
import swal from 'sweetalert2';

import {ref} from "Vue";

export default {
    name: "index",
    components:{headerComponent},
    setup() {
        let localIds = window.localStorage.getItem('product_ids')
        let ids = JSON.parse(localIds);

        let products = ref([]);
        let total_price = ref(0);

        let discountPercentage = ref(null)
        let couponCode = ref('')
        let afterDiscount = ref(0)

        let buyProduct = () => {
            swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Thank you for trust',
                showConfirmButton: false,
                timer: 1500
            });
        }

       async function getCart(){
           let res = await axios.post('/main/get-carts', {
               ids
           })
           products.value = res.data.products
           total_price.value = res.data.total_price
       }


        let count = ref({});
        let price = ref({});

        let increaseItem = (product_id, priceValue) =>{
            let countVal = count.value[`product_value_${product_id}`] ?? 1;
            countVal++
            window.localStorage.setItem(`product_value_${product_id}`, countVal)
            count.value[`product_value_${product_id}`] = countVal;
            price.value[`price_${product_id}`] = countVal * priceValue;
            total_price.value = (countVal * priceValue);
            return applyDiscount()
       }

        let decreaseItem = (product_id, priceValue) =>{
            let countVal = count.value[`product_value_${product_id}`] ?? 1;
            countVal--
            if ((countVal >= 1))
            {
                window.localStorage.setItem(`product_value_${product_id}`, countVal)
                count.value[`product_value_${product_id}`] = countVal;
                price.value[`price_${product_id}`] = countVal * priceValue;
                total_price.value = (countVal * priceValue);
                return applyDiscount()
            }

        }

       let deleteItem = (product_id) => {
         let IndexProduct = ids.indexOf(product_id)

           if (IndexProduct > -1) {
               ids.splice(IndexProduct, 1);
           }

        window.localStorage.setItem('product_ids', `[${ids}]`)
        if (ids.leading === 0){
            window.localStorage.removeItem('product_ids')
            afterDiscount.value = 0
        }
          return getCart()
        }

        async function applyDiscount() {
           let res = await axios.post('/main/coupon-value', {
               code : couponCode.value
           })
           let discount =  discountPercentage.value = res.data

            afterDiscount.value = total_price.value - (total_price.value * discount / 100);

          console.log(discount)

        }




       getCart()
        return {products,discountPercentage,buyProduct,  increaseItem,decreaseItem, count, price, deleteItem, applyDiscount, total_price, couponCode, afterDiscount}
    }
}
</script>

<style scoped>

</style>
