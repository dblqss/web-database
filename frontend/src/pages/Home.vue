<script setup>
</script>

<template>
  <div class="w-full min-h-screen bg-[#f6f1e7]">

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
      
      <div>
        <h1 class="text-5xl font-bold text-[#4b3f35] leading-tight">
          Belanja Mudah & Cepat di 
          <span class="text-[#7da8c3]">MyShop</span>
        </h1>

        <p class="mt-6 text-gray-600 text-lg">
          Temukan berbagai produk terbaik dengan harga terjangkau, 
          kualitas terjamin, dan pengiriman cepat ke seluruh Indonesia.
        </p>

        <div class="mt-8 flex gap-4">
          <router-link 
            to="/stok"
            class="bg-[#7da8c3] text-white px-6 py-3 rounded-xl hover:opacity-90 transition"
          >
            Lihat Produk
          </router-link>

          <router-link 
            to="/transaksi"
            class="border border-[#7da8c3] text-[#7da8c3] px-6 py-3 rounded-xl hover:bg-[#7da8c3] hover:text-white transition"
          >
            Cek Transaksi
          </router-link>
        </div>
      </div>

      <!-- IMAGE -->
      <div class="hidden md:block">
        <img 
          src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da"
          class="rounded-2xl shadow-lg object-cover h-[400px] w-full"
        />
      </div>

    </section>

    <!-- FITUR -->
    <section class="bg-white py-16">
      <div class="max-w-7xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold text-[#4b3f35] mb-10">
          Kenapa Pilih MyShop?
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

          <div class="p-6 rounded-xl border hover:shadow-md transition">
            <h3 class="text-xl font-semibold mb-2">🚀 Cepat</h3>
            <p class="text-gray-600">
              Proses transaksi cepat dan pengiriman kilat ke seluruh Indonesia.
            </p>
          </div>

          <div class="p-6 rounded-xl border hover:shadow-md transition">
            <h3 class="text-xl font-semibold mb-2">🔒 Aman</h3>
            <p class="text-gray-600">
              Data dan pembayaran kamu dijamin aman dan terpercaya.
            </p>
          </div>

          <div class="p-6 rounded-xl border hover:shadow-md transition">
            <h3 class="text-xl font-semibold mb-2">💎 Berkualitas</h3>
            <p class="text-gray-600">
              Produk pilihan dengan kualitas terbaik dan harga bersahabat.
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- CTA -->
    <section class="py-20 text-center">
      <h2 class="text-3xl font-bold text-[#4b3f35]">
        Siap mulai belanja?
      </h2>

      <p class="text-gray-600 mt-4">
        Jelajahi produk sekarang dan temukan yang kamu butuhkan!
      </p>

      <router-link 
        to="/stok"
        class="inline-block mt-6 bg-[#7da8c3] text-white px-8 py-3 rounded-xl hover:opacity-90 transition"
      >
        Mulai Sekarang
      </router-link>
    </section>

  </div>
</template>