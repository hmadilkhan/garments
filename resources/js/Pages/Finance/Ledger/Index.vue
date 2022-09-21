<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed, onMounted, ref,toRefs } from "vue";
import feather from "feather-icons";
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps(["ledgers","subAccountId"])

onMounted(() => {
    feather.replace();
});

const form = useForm({
  id: "",
  sub_account_id: props.subAccountId,
  amount: "",
  narration: "",
  type: "",
});

function submit() {
    Inertia.post(route("ledger.store"),form,{
        onSuccess: () => {
            form.reset()
            feather.replace()
        },

    });
}

function cancel(){
    form.reset();
}
</script>
 <template>
 <Head title="Ledger List" />
 <AuthenticatedLayout>
     <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ledger
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
            <input type="hidden" v-model="form.sub_account_id"/>
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
                Amount
              </label>
              <input
                v-model="form.amount"
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
                placeholder="Amount"
              />
              <InputError
                :message="form.errors.amount"
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
                Narration
              </label>
              <input
                v-model="form.narration"
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
                placeholder="Account Title"
              />
              <InputError
                :message="form.errors.narration"
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
                Account Type
              </label>
              <select v-model="form.type" class="
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
                ">
                <option  value="CR">CR</option>
                <option  value="DR">DR</option>
              </select>
              <InputError
                :message="form.errors.type"
                class="mt-2 text-red-500 text-xs italic"
              />
            </div>


            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
            </div>
            <div class="w-full md:w-1/2 px-3 mt-3 md:mb-0">
              <button @click="cancel" type="button" class="float-right mt-4 ml-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
               Cancel
              </button>
              <PrimaryButton class="mt-4 float-right " >Save</PrimaryButton>
            </div>
          </div>
        </form>
      </div>
       <div class="intro-y col-span-6 overflow-auto lg:overflow-visible">
          <table class="table table-report -mt-2">
            <thead>
              <tr>
                <th class="text-center whitespace-nowrap">AMOUNT</th>
                <th class="text-center whitespace-nowrap">NARRATION</th>
                <th class="text-center whitespace-nowrap">TYPE</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="ledger in props.ledgers" :key="ledger.id" class="intro-x">
                    <td class="text-center">{{ ledger.amount }}</td>
                    <td class="text-center">{{ ledger.narration }}</td>
                    <td class="text-center">{{ ledger.type }}</td>
                </tr>
            </tbody>
          </table>
       </div>
    </div>
  </AuthenticatedLayout>
 </template>
