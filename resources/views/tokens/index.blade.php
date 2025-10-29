<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      API tokens
    </h2>
  </x-slot>

  <div id="app">
    <x-container class="py-8">
      <x-form-section class="mb-12" title="Crear un nuevo Token"
        description="Ingrese los datos solicitado para poder crear un nuevo access token" :buttons="true">

        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-4">
            <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
              v-if="Object.keys(form.errors).length > 0">
              <strong>Se encontro un error!</strong>
              <ul>
                <li v-for="(messages, field) in form.errors" :key="field">
                  <span v-for="message in messages" :key="message">@{{ message }}</span>
                </li>
              </ul>
            </div>
            <x-input v-model="form.name" type="text" class="mt-1 w-full" label="Nombre" />

            <div v-if="scopes.length > 0">
              <label>
                Scopes
              </label>
              <div v-for="scope in scopes">
                <label>
                  <input type="checkbox" name="scopes" :value="scope.id" v-model="form.scopes">
                  @{{ scope.id }}
                </label>
              </div>
            </div>
          </div>
        </div>
        <x-slot name="actions">
          <x-primary-button v-on:click="store" v-bind:disabled="form.disabled">Crear</x-primary-button>
        </x-slot>
      </x-form-section>

      <x-form-section title="Ver listado de tokens" description="Los tokens registrados" :buttons="false">
        <div>
          <table class="text-gray-600">
            <thead class="border-b border-gray-300">
              <tr class="text-left">
                <th class="w-full py-2">Nombre</th>
                <th class="py-2">Acción</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
              <tr v-for="values in tokens">
                <td>
                  @{{ values.name ?? 'Nombre no registrado'}}
                </td>
                <td class="flex gap-4">
                  <a class="cursor-pointer pl-2 font-semibold hover:text-green-600" v-on:click="show(values.id)">Ver</a>
                  <a class="cursor-pointer pl-2 font-semibold hover:text-red-600"
                    v-on:click="destroy(values.id)">Eliminar</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </x-form-section>
    </x-container>

    <x-modal-tailwind title="Ver cliente" visible="showForm.open">
      <x-slot name="content">
        <div class="overflow-auto text-white">
          <h1>
            <span>Token id: </span>
            <span>@{{ showForm.id }}</span>
          </h1>
        </div>
        <x-slot name="footer">
          <button type="button" v-on:click="showForm.open = false"
            class="shadow-xs inset-ring inset-ring-gray-300 dark:inset-ring-white/5 mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-white/10 dark:text-white dark:shadow-none dark:hover:bg-white/20">Cancel</button>
        </x-slot>
      </x-slot>
    </x-modal-tailwind>
  </div>

  @push('js')
    <script>
      const {
        createApp
      } = Vue

      createApp({
        data() {
          return {
            tokens: [],
            scopes: [],
            form: {
              errors: [],
              scopes: [],
              disabled: false,
              name: ''
            },
            showForm: {
              open: false,
              id: ''
            }
          }
        },
        methods: {
          getScopes() {
            axios.get('/tokens/access-tokens/scopes')
              .then(response => {
                this.scopes = response.data
              })
          },
          index() {
            axios.get('/tokens/access-tokens')
              .then(response => {
                this.tokens = response.data
              })
          },
          async store() {
            this.form.disabled = true;
            try {
              const response = await axios.post('/tokens/access-tokens', this.form, {
                headers: {
                  'Accept': 'application/json'
                }
              });

              this.form.name = '';
              this.form.errors = [];
              this.form.scopes = [];
              this.form.disabled = false;

              Swal.fire('Creado', "El token fue creado correctamente", 'success')

              this.index();
            } catch (error) {
              this.form.errors = error.response?.data?.errors || []
            }
            this.form.disabled = false;
          },
          destroy(token) {
            Swal.fire({
              title: "Estas seguro que quieres eliminar este token?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "d33",
              confirmButtonText: "Si, estoy seguro",
            }).then((result) => {
              if (result.isConfirmed) {

                axios.delete('/tokens/access-tokens/' + token)
                  .then(() => {

                    Swal.fire("Eliminado!", "Se elimino el token correctamente", "success")

                    this.index()
                  })
              }
            })
          },
          show(token) {
            axios.get('/tokens/access-tokens/' + token)
              .then(response => {
                this.showForm.open = true
                this.showForm.id = response.data.id
              })
          }
        },
        mounted() {
          this.index();
          this.getScopes();
        }
      }).mount('#app')
    </script>
  @endpush

</x-app-layout>
