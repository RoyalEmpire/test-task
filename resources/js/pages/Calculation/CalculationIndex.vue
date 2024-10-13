<template>
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-md">
        <h2 class="text-2xl font-semibold mb-4">Calculating the cost of a product</h2>
        <form @submit.prevent="calculatePrice">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Base price</label>
                <input type="number" v-model="basePrice" class="w-full p-2 border rounded" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Category</label>
                <select v-model="category" class="w-full p-2 border rounded" required>
                    <option value="electronics">Electronics</option>
                    <option value="furniture">Furniture</option>
                    <option value="clothes">Cloth</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Location</label>
                <select v-model="location" class="w-full p-2 border rounded" required>
                    <option value="kiev">Kyiv</option>
                    <option value="lviv">Lviv</option>
                    <option value="odessa">Odessa</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Quantity</label>
                <input type="number" v-model="quantity" class="w-full p-2 border rounded" required />
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded">
                Calculate
            </button>
        </form>

        <div v-if="calculatedData" class="mt-6">
            <h3 class="text-xl font-semibold mb-2">Result:</h3>
            <ul class="list-disc pl-6">
                <li v-for="(item, index) in calculatedData.details" :key="index">{{ item }}</li>
            </ul>
            <p class="mt-4 text-lg font-bold">Итоговая стоимость: {{ calculatedData.totalPrice }} $</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userType: 'seller',
            basePrice: '',
            category: '',
            location: '',
            quantity: 1,
            calculatedData: null,
        };
    },
    methods: {
        async calculatePrice() {
            try {
                const response = await axios.post('/api/v1/products/calculate', {
                    userType: this.userType,
                    basePrice: this.basePrice,
                    category: this.category,
                    location: this.location,
                    quantity: this.quantity,
                });
                this.calculatedData = response.data;
                console.log(this.calculatedData, response.data)
            } catch (error) {
                console.error('Error in cost calculation:', error);
            }
        },
    },
};
</script>
