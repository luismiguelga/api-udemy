<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      Clientes
    </h2>
  </x-slot>

  <x-container id="app" class="py-8">
    <x-form-section class="mb-12" title="Crear un nuevo cliente"
      description="Ingrese los datos solicitado para poder crear un nuevo cliente" :buttons="true" :method="'store'">
      <div class="grid grid-cols-6 gap-6">
        <div class="col-span-4">
          <x-input v-model="createForm.name" type="text" class="mt-1 w-full" label="Nombre" />
        </div>
        <div class="col-span-4">
          <x-input v-model="createForm.redirect" type="text" class="mt-1 w-full" label="URL de redirección" />
        </div>
      </div>
      <x-slot name="actions">
        <x-primary-button v-on:click="store">Crear</x-primary-button>
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
            @foreach ($users as $value)
              <tr>
                <td>
                  {{ $value->name }}
                </td>
                <td class="flex gap-4">
                  <x-primary-button v-on:click="store">Editar</x-primary-button>
                  <x-primary-button v-on:click="store">Eliminar</x-primary-button>
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </x-form-section>
  </x-container>


  @push('js')
    <script>
      const {
        createApp
      } = Vue

      createApp({
        data() {
          return {
            createForm: {
              errors: [],
              name: 'testing',
              redirect: 'testing'
            }
          }
        },
        methods: {
          async store() {
            try {
              const response = await axios.post('api/oauth/clients', this.createForm, {
                headers: {
                  'Accept': 'application/json'
                }
              });

              this.createForm.name = ''
              this.createForm.redirect = ''

              Swal.fire(
                'Creado',
                'El cliente fue creado correctamente',
                'success'
              )
            } catch (error) {
              console.log(error);

              this.createForm.errors = error.response?.data?.errors || []
              Swal.fire(
                'Error',
                'Algo ha salido a salido mal',
                'error'
              )
            }
          }
        }
      }).mount('#app')
    </script>
  @endpush


  {{-- @push('js')
    <script>
      const {
        createApp
      } = Vue;

      createApp({
        data() {
          return {
            createForm: {
              name: "testing",
              redirect: "testing",
            }
          };
        }
      }).mount('#app');
    </script>
  @endpush --}}

</x-app-layout>
