<template>
  <main>
      <div class="container">
          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                          <div class="d-flex justify-content-center">
                              <a href="#" class="logo-login d-flex align-items-center w-auto">
                                  <img :src="gambarUrl" alt="logo">
                              </a>
                          </div>
                          <!-- End Logo -->
                          <div class="card mb-3">
                              <div class="card-body">
                                  <div class="pt-4 pb-2">
                                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                      <p class="text-center small">Enter your personal number & password to login</p>
                                  </div>

                                  <form class="row g-3 needs-validation" novalidate @submit.prevent="handleLogin">
                                      <div class="col-12">
                                          <label for="personalNumber" class="form-label">Personal Number</label>
                                          <div class="input-group has-validation">
                                              <input type="text" autocomplete="" name="personal_number" v-model="credential.personal_number" class="form-control text-center" placeholder="00710xxxx" id="personalNumber" required>
                                              <div class="invalid-feedback">Please enter your personal number</div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <label for="yourPassword" class="form-label">Password</label>
                                          <input type="password" name="password" class="form-control text-center" autocomplete="" v-model="credential.password" id="yourPassword" placeholder="**********" required>
                                          <div class="invalid-feedback">Please enter your password!</div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                              <label class="form-check-label" for="rememberMe">Remember me</label>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <button class="btn btn-primary w-100" type="submit">Login</button>
                                      </div>
                                      <div class="col-12">
                                          <p class="small mb-0">Don't have account? <a href="#">Call IT Suport</a></p>
                                      </div>
                                  </form>

                              </div>
                          </div>

                          <div class="credits">
                              Designed by <a href="https://bootstrapmade.com/">PT Bringin Gigantara CHM-ITM</a>
                          </div>

                      </div>
                  </div>
              </div>

          </section>

      </div>
  </main>
  <!-- End #main -->
  </template>


  <script>
  import {useRouter} from "vue-router";
  import {useStore} from 'vuex';
  import bgiLogo from '/public/assets/img/bgi_logo.png';

  export default {
      name: "Login",
      setup() {
          const store = useStore()
          const router = useRouter();

          const credential = {
              personal_number: '',
              password: ''
          };

          const handleLogin = () => {
            store.dispatch('authLogin', credential)
            .then(() => {
              router.push({
                name: "Dashboard"
              })
            })
          };

          return {
              credential,
              handleLogin,
              gambarUrl: bgiLogo
          }
      },
  }
  </script>
