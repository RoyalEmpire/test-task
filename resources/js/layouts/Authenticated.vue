<template>
    <div class="w-full">
        <div class="bg-gray-100 w-full py-4 text-center">
            <div class="text-2xl font-bold">Top bar</div>
        </div>
        <div class="flex justify-center space-x-4 my-4">
            <router-link class="text-blue-500 hover:underline" to="/">Home</router-link>
            <router-link class="text-blue-500 hover:underline" to="/calculation">Calculation</router-link>
        </div>
        <div class="w-full flex justify-center">
            <RouterView />
        </div>
    </div>
</template>
