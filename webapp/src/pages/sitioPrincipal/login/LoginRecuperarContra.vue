<!-- login Access template-->
<template>
  <!-- Page content -->
  <q-page class="flex flex-center">
    <div class="row full-width flex flex-center">
      <div class="col-md-4 col-sm-7 col-xs-10">
        <!-- Centered card -->
        <q-card>
          <q-card-section>
            <q-avatar size="115px" class="absolute-center shadow-10">
              <img src="logo.png" class="bg-secondary" />
            </q-avatar>
          </q-card-section>
          <q-card-section>
            <div class="text-center q-pt-lg">
              <div class="col text-h6 ellipsis">Employee Portal</div>
              <div class="col text-subtitle1 ellipsis"></div>
            </div>
          </q-card-section>
          <q-card-section>
            <q-form class="q-gutter-lg">
              <q-input
                label="Email"
                outlined
                v-model="login.username"
                maxlength="254"
                clear-icon="close"
                :rules="[
                  (val) => val.length > 0 || 'Please enter an email',
                  (val) =>
                    login.validEmail(val) || 'Please enter a valid email',
                ]"
                hide-bottom-space
              />

              <div align="left">
                <span class="text-grey"
                  >The process will continue in your own email</span
                >
              </div>

              <div class="row">
                <div class="col-12" align="right">
                  <q-btn
                    label="Return to login"
                    to="/dashboard/login"
                    color="primary"
                    class="q-mr-sm"
                  />

                  <q-btn label="Recover" type="submit" color="primary" />
                </div>
              </div>
            </q-form>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import { useLoginStore } from 'src/stores/dashboard/login';

export default defineComponent({
  setup() {
    const login = useLoginStore();
    return {
      login,
    };
  },
});
</script>
