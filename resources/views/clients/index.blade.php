<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      Clientes
    </h2>
  </x-slot>

  <div id="app">
    <x-container class="py-8">
      <x-form-section class="mb-12" title="Crear un nuevo cliente"
        description="Ingrese los datos solicitado para poder crear un nuevo cliente" :buttons="true" :method="'store'">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-4">

            <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
              v-if="Object.keys(createForm.errors).length > 0">
              <strong>Se encontro un error!</strong>
              <ul>
                <li v-for="(messages, field) in createForm.errors" :key="field">
                  <span v-for="message in messages" :key="message">@{{ message }}</span>
                </li>
              </ul>
            </div>

            <x-input v-model="createForm.name" type="text" class="mt-1 w-full" label="Nombre" />
          </div>
          <div class="col-span-4">
            <x-input v-model="createForm.redirect_uris" type="text" class="mt-1 w-full" label="URL de redirección" />
          </div>
        </div>
        <x-slot name="actions">
          <x-primary-button v-on:click="store" v-bind:disabled="createForm.disabled">Crear</x-primary-button>
        </x-slot>
      </x-form-section>

      <x-form-section title="Ver listado de clientes" description="Los clientes registrados" :buttons="false">
        <div>
          <table class="text-gray-600">
            <thead class="border-b border-gray-300">
              <tr class="text-left">
                <th class="w-full py-2">Nombre</th>
                <th class="py-2">Acción</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
              <tr v-for="values in clients">
                <td>
                  @{{ values.name }}
                </td>
                <td class="flex gap-4">
                  <a class="cursor-pointer pl-2 font-semibold hover:text-green-600" v-on:click="show(values.id)">Ver</a>
                  <button command="show-modal" commandfor="dialog"
                    class="cursor-pointer pl-2 font-semibold hover:text-blue-600" v-on:click="edit(values.id)">
                    Editar </button>
                  <a class="cursor-pointer pl-2 font-semibold hover:text-red-600"
                    v-on:click="destroy(values.id)">Eliminar</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </x-form-section>
    </x-container>

    {{-- Modal --}}
    <x-modal-tailwind title="Editar cliente" visible="editForm.open">
      <x-slot name="content">
        <div class="">
          <div class="col-span-6 sm:col-span-4">
            <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
              v-if="Object.keys(editForm.errors).length > 0">
              <strong>Se encontro un error!</strong>
              <ul>
                <li v-for="(messages, field) in editForm.errors" :key="field">
                  <span v-for="message in messages" :key="message">@{{ message }}</span>
                </li>
              </ul>
            </div>
            <x-input v-model="editForm.name" type="text" class="mt-1 w-full" label="Nombre" />
          </div>
          <div class="col-span-4">
            <x-input v-model="editForm.redirect_uris" type="text" class="mt-1 w-full" label="URL de redirección" />
          </div>
        </div>
        <x-slot name="footer">
          <button type="button" v-on:click="update(editForm.id)"
            class="shadow-xs inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500 sm:ml-3 sm:w-auto dark:bg-red-500 dark:shadow-none dark:hover:bg-red-400">Guardar</button>
          <button type="button" v-on:click="editForm.open = false"
            class="shadow-xs inset-ring inset-ring-gray-300 dark:inset-ring-white/5 mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-white/10 dark:text-white dark:shadow-none dark:hover:bg-white/20">Cancel</button>
        </x-slot>
      </x-slot>
    </x-modal-tailwind>

    <x-modal-tailwind title="Ver cliente" visible="showForm.open">
      <x-slot name="content">
        <div class="text-white">
          <h1>
            <span>Cliente: </span>
            <span>@{{ showForm.client }}</span>
          </h1>
          <h1>
            <span>Cliente_id: </span>
            <span>@{{ showForm.client_id }}</span>
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
            clients: [],
            showForm: {
              client: '',
              client_id: '',
              client_secret: '',
              open: false
            },
            createForm: {
              errors: [],
              name: '',
              redirect: '',
              disabled: false
            },
            editForm: {
              errors: [],
              id: '',
              name: '',
              redirect_uris: '',
              open: false,
              disabled: false
            }
          }
        },
        methods: {
          index() {
            axios.get('oauth/clients')
              .then(response => {
                this.clients = response.data
              })
          },
          async store() {
            this.createForm.disabled = true;
            try {
              const response = await axios.post('oauth/clients', this.createForm, {
                headers: {
                  'Accept': 'application/json'
                }
              });
              console.log(response.data);

              this.createForm.name = ''
              this.createForm.redirect_uris = ''
              this.createForm.errors = []

              Swal.fire('Creado', 'El cliente fue creado correctamente, el cliente_secret es: ' + response.data, 'success')
              this.index();

            } catch (error) {
              this.createForm.errors = error.response?.data?.errors || []
            }
            this.createForm.disabled = false;
          },
          destroy(client) {
            Swal.fire({
              title: "Estas seguro que quiere eliminar este cliente?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, estoy seguro"
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete('oauth/clients/' + client)
                  .then(() => {
                    Swal.fire("Eliminado!", "Se elimilo el cliente correctamente", "success");
                    this.index();
                  });
              }
            });
          },
          edit(client) {
            this.editForm.open = true
            axios.get('oauth/clients/' + client)
              .then(response => {
                this.editForm.id = response.data.id
                this.editForm.name = response.data.name
                this.editForm.redirect_uris = response.data.redirect_uris
              })
          },
          async update(client) {
            try {
              const respuesta = await axios.put('oauth/clients/' + client, this.editForm, {
                  headers: {
                    'Accept': 'application/json'
                  }
                })
                .then(response => {
                  Swal.fire('Todo ha salido bien', 'El cliente fue actualizado correctamente', 'success')

                  this.index();
                })
              this.editForm.open = false
            } catch (error) {
              this.editForm.errors = error.response?.data?.errors || []
            }
          },
          show(client) {
            this.showForm.open = true
            axios.get('oauth/clients/show/' + client)
              .then(response => {
                this.showForm.client = response.data.name;
                this.showForm.client_id = response.data.id;
                this.showForm.client_secret = response.data.secret;
              })
          }
        },
        mounted() {
          this.index();
        }
      }).mount('#app')
    </script>
  @endpush
</x-app-layout>
