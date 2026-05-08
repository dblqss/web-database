<script setup>
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const isActive = (path) => route.path === path

const logout = () => {
  localStorage.removeItem('isLogin')
  router.push('/login')
}
</script>

<template>
  <nav class="sticky top-0 z-50 backdrop-blur bg-white/70 border-b border-slate-200">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

      <!-- LOGO -->
      <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
        My<span class="text-[#7da8c3]">Shop</span>
      </h1>

      <!-- MENU -->
      <div class="hidden md:flex items-center gap-2 bg-[#f0f6fa] p-1 rounded-xl">

        <RouterLink 
          to="/home" 
          :class="isActive('/home') 
            ? 'bg-white text-[#7da8c3] shadow px-4 py-2 rounded-lg text-sm font-medium' 
            : 'text-slate-600 hover:text-[#7da8c3] px-4 py-2 rounded-lg text-sm transition'"
        >
          Home
        </RouterLink>

        <RouterLink 
          to="/stok" 
          :class="isActive('/stok') 
            ? 'bg-white text-[#7da8c3] shadow px-4 py-2 rounded-lg text-sm font-medium' 
            : 'text-slate-600 hover:text-[#7da8c3] px-4 py-2 rounded-lg text-sm transition'"
        >
          Stok
        </RouterLink>

        <RouterLink 
          to="/transaksi" 
          :class="isActive('/transaksi') 
            ? 'bg-white text-[#7da8c3] shadow px-4 py-2 rounded-lg text-sm font-medium' 
            : 'text-slate-600 hover:text-[#7da8c3] px-4 py-2 rounded-lg text-sm transition'"
        >
          Transaksi
        </RouterLink>

      </div>

      <!-- LOGOUT BUTTON -->
      <button
        @click="logout"
        class="bg-[#7da8c3] text-white px-5 py-2 rounded-xl text-sm font-medium hover:opacity-90 transition shadow-sm"
      >
        Logout
      </button>

    </div>

  </nav>
</template>