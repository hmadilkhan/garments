<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from '@/Components/Pagination.vue'
import { computed, onMounted, ref } from "vue";
import feather from "feather-icons";
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";



const props = defineProps(["sellers"]);
console.log(props.sellers.links.length);


let isUpdate = ref(false);
function changeUpdate(value){
    isUpdate.value = value;
}

const buttonName = computed(() => isUpdate.value == true ? "Update" : "Save");

onMounted(() => {
    feather.replace();
});


const form = useForm({
  id: "",
  name: "",
  phone: "",
  address: "",
  bank_name: "",
  account_no: "",
  bank: "",
  subaccountId: "",
});

function submit() {
    if (isUpdate.value == true) {
        form.put(route("seller.update",form.id),{
        onSuccess: () => {
            form.reset()
            feather.replace()
            changeUpdate(false)
        },
    });
    }else{
        form.post(route("seller.store"),{
            onSuccess: () => {
                form.reset();
                feather.replace();
            },
        });
    }


}
function edit(id,name,phone,address,bank_name,account_no,bank,subAccountId) {
    this.form.id = id;
    this.form.name = name;
    this.form.phone = phone;
    this.form.address = address;
    this.form.bank_name = bank_name;
    this.form.account_no = account_no;
    this.form.bank = bank;
    this.form.subaccountId = subAccountId;
    changeUpdate(true)
}

function deleteUnit(id) {
    Inertia.delete(route("seller.destroy",id))
}
function cancel(){
    form.reset();
    changeUpdate(false)
}
</script>
 <template>
 <Head title="Sellers List" />
 <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
        Sellers List
      </h2>
    </template>
    <div class="py-6">
      <div class="sm:px-6 lg:px-8">
        <form
          @submit.prevent="submit"
          class="w-full border-b border-gray-200"
        >
          <div class="flex flex-wrap -mx-3 mb-6">
            <input type="hidden" v-model="form.id"/>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Name
              </label>
              <input
                v-model="form.name"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Seller Name"
              />
              <InputError
                :message="form.errors.name"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Phone
              </label>
              <input
                v-model="form.phone"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Phone"
              />
              <InputError
                :message="form.errors.phone"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Address
              </label>
              <input
                v-model="form.address"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Address"
              />
              <InputError
                :message="form.errors.address"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Bank Name
              </label>
              <input
                v-model="form.bank_name"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Bank Name"
              />
              <InputError
                :message="form.errors.bank_name"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Account Number
              </label>
              <input
                v-model="form.account_no"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Account Number"
              />
              <InputError
                :message="form.errors.account_no"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label
                class="
                  block
                  uppercase
                  tracking-wide
                  text-gray-700 text-xs
                  font-bold
                  mb-2
                "
                for="grid-first-name"
              >
                Bank Details
              </label>
              <input
                v-model="form.bank"
                class="
                  appearance-none
                  block
                  w-full
                  bg-gray-200
                  text-gray-700
                  rounded
                  py-3
                  px-4
                  mb-3
                  leading-tight
                  focus:outline-none focus:bg-white
                "
                id="grid-first-name"
                type="text"
                placeholder="Bank Details"
              />
              <InputError
                :message="form.errors.bank"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>

            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
            </div>
            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
              <button @click="cancel" type="button" class="float-right mt-4 ml-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
               Cancel
              </button>
              <PrimaryButton class="mt-4 float-right " >{{buttonName}}</PrimaryButton>
            </div>
          </div>
        </form>
      </div>
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

    </div>
  </AuthenticatedLayout>
 </template>
