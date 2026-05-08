<script setup>
import { ref, onMounted } from 'vue'

const transaksi = ref([])

onMounted(async () => {
  const res = await fetch('http://https://myshop42.infinityfreeapp.com/api.php')
  transaksi.value = await res.json()
})
</script>

<template>
  <div class="min-h-screen bg-[#f6f1e7] flex justify-center">

    <!-- WRAPPER CENTER -->
    <div class="w-full max-w-6xl p-8">

      <!-- TITLE -->
      <h2 class="text-xl font-bold text-[#4b3f35] mb-6">
        📊 Transaksi
      </h2>

      <!-- CARD -->
      <div class="bg-white border border-[#e7dccf] rounded-2xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

          <table class="w-full text-sm">

            <thead class="bg-[#fffaf3] text-[#4b3f35]">
              <tr>
                <th class="p-4 text-left">Nama</th>
                <th class="p-4 text-left">Produk</th>
                <th class="p-4 text-center">Jumlah</th>
                <th class="p-4 text-center">Subtotal</th>
                <th class="p-4 text-center">Status</th>
              </tr>
            </thead>

            <tbody>
              <tr 
                v-for="t in transaksi"
                :key="t.id"
                class="border-t hover:bg-[#fffaf3] transition"
              >
                <td class="p-4 font-medium text-[#4b3f35]">{{ t.nama }}</td>
                <td class="p-4 text-[#6b5b4b]">{{ t.nama_produk }}</td>

                <td class="p-4 text-center">{{ t.jumlah }}</td>

                <td class="p-4 text-center text-[#7da8c3] font-semibold">
                  Rp {{ new Intl.NumberFormat('id-ID').format(t.subtotal) }}
                </td>

                <td class="p-4 text-center">
                  <span 
                    :class="t.status === 'Lunas'
                      ? 'bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs'
                      : 'bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs'"
                  >
                    {{ t.status }}
                  </span>
                </td>

              </tr>
            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>
</template>