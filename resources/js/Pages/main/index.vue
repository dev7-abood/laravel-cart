<template>
    <header-component/>
    <product-component :catOfProducts="catOfProducts"/>
</template>

<script>
import headerComponent from "./components/header-component";
import productComponent from "./components/products-component";

export default {
    name: "Index",
    props : ['catOfProducts'],
    components:{
        headerComponent,productComponent
    }
}
</script>

<style scoped>

</style>
