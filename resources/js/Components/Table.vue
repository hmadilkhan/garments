<script setup>
defineProps(["links"]);
</script>
<template>
    <div class="intro-y col-span-6 overflow-auto lg:overflow-visible">
         <div class="md:w-full  py-3 pl-2">
            <div class="relative max-w-full float-right mr-3">
                <label for="hs-table-search" class="sr-only">
                    Search
                </label>
                <input
                    type="text"
                    name="search"
                    class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                    placeholder="Search..."
                />
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </div>
            </div>
         </div>
          <table class="table table-report -mt-2">
            <thead>
              <tr>
                <th class="text-center whitespace-nowrap">SELLER</th>
                <th class="text-center whitespace-nowrap">SYSTEM ACCOUNT NAME</th>
                <th class="text-center whitespace-nowrap">PHONE</th>
                <th class="text-center whitespace-nowrap">ADDRESS</th>
                <th class="text-center whitespace-nowrap">BANK NAME</th>
                <th class="text-center whitespace-nowrap">ACCOUNT NUMBER</th>
                <th class="text-center whitespace-nowrap">BANK DETAILS</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="seller in sellers.data" :key="seller.id" class="intro-x">
                    <td class="text-center">{{ seller.name }}</td>
                    <td class="text-center">{{ seller.subaccount.title }}</td>
                    <td class="text-center">{{ seller.phone }}</td>
                    <td class="text-center">{{ seller.address }}</td>
                    <td class="text-center">{{ seller.bank_name }}</td>
                    <td class="text-center">{{ seller.account_no }}</td>
                    <td class="text-center">{{ seller.bank }}</td>
                    <td class="table-report__action w-56">
                  <div class="flex justify-center items-center">
                    <a
                      class="flex items-center mr-3 cursor-pointer"
                      @click="edit(seller.id,seller.name,seller.phone,seller.address,seller.bank_name,seller.account_no,seller.bank,seller.subaccount.id)"
                    >
                      <i data-feather="check-square" class="w-4 h-4 mr-1"></i>
                      Edit
                    </a>
                    <a
                      class="flex items-center text-danger cursor-pointer"
                      @click="deleteUnit(seller.id)"
                    >
                      <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                      Delete
                    </a>
                  </div>
                </td>
                </tr>
            </tbody>
          </table>
          <pagination class="mt-6" :links="sellers.links" />
    </div>
</template>
