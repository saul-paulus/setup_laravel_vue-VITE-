<template>

<div class="w-full flex flex-col items-center justify-center px-6 pt-8 mx-auto pt:mt-0 dark:bg-gray-900">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Login With Your Account
        </h2>
    </div>
	<!-- Card -->
	<div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
		<form class="mt-8 space-y-6" @submit.prevent="handleLogin">
			<div>
				<label for="personal_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personal Number</label>
				<input type="text" name="personal_number"  autocomplete id="personal_number" v-model="credential.personal_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 text-center" placeholder="6352XXX" required="">
			</div>
			<div>
				<label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
				<input type="password"  autocomplete name="password" id="password" v-model="credential.password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 text-center" required="">
			</div>
			<div class="flex items-start flex-wrap">
				<div class="flex items-center h-5">
					<input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 text-center" required="">
				</div>
				<div class="ml-3 text-sm">
					<label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
				</div>
			</div>
			<button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-primary-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">Login to your account</button>
			<div class="text-sm font-medium text-gray-500 dark:text-gray-400">
				Not registered? <a class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
			</div>
		</form>
	</div>
</div>
</template>


<script>

  import {useRouter} from "vue-router";
  import { useStore } from 'vuex';


  export default {
    name: "Login",
    setup(){
      const store = useStore()
      const router  = useRouter();

      const credential = {
          personal_number: '',
          password: ''
        };

      const handleLogin = ()=>{
        store.dispatch('authLogin', credential)
        .then(()=>{
          router.push({
            name:"Dashboard"
          })
          window.location.reload();
        })
        .catch(error => {
            console.log(error);
        });
      };

      return {
        credential,
        handleLogin
      }
    },

  }

</script>
