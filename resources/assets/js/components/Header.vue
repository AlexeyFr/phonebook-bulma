<template>
    <nav class="navbar" aria-label="main navigation">
        <div class="navbar-brand">
            <div class="navbar-menu is-active">
                <router-link :to="{ name: 'home'}" class="navbar-item">Home</router-link>
                <router-link :to="{ name: 'about'}" class="navbar-item">About</router-link>
            </div>
        </div>
    </nav>
</template>