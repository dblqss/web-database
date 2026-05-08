import { createRouter, createWebHistory } from 'vue-router'

import Login from '../pages/Login.vue'
import Home from '../pages/Home.vue'
import Stok from '../pages/Stok.vue'
import Transaksi from '../pages/Transaksi.vue'
import DetailProduk from '../pages/DetailProduk.vue'

const routes = [

  // halaman awal
  {
    path: '/',
    redirect: '/login'
  },

  // login
  {
    path: '/login',
    name: 'login',
    component: Login
  },

  // home
  {
    path: '/home',
    name: 'home',
    component: Home
  },

  // stok
  {
    path: '/stok',
    name: 'stok',
    component: Stok
  },

  // transaksi
  {
    path: '/transaksi',
    name: 'transaksi',
    component: Transaksi
  },

  // detail produk
  {
    path: '/produk/:id',
    name: 'detail-produk',
    component: DetailProduk
  }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router