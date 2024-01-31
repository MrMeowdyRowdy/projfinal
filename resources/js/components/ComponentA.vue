<template>
    <input type="text" placeholder="Filtrar por sede, proveedor, lenguaje o tipo" v-model="filter" />
    <v-table :data="llamadas">
        <thead slot="head">
            <th>ID Llamada</th>
            <th>Sede</th>
            <th>InterpreterID</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Duracion</th>
            <th>Proveedor</th>
            <th>Lenguaje</th>
            <th>Categoria</th>
        </thead>
        <tbody slot="body" slot-scope="{displayData}">
            <tr v-for="(llamada, index) in filteredRows" :key="`llamada-${index}`">

                <td>{{ llamada.id }}</td>
                <td v-html="highlightMatches(llamada.sede)"></td>

                <td>{{ llamada.interpreterID }}</td>
                <td>{{ llamada.horaInicio }}</td>
                <td>{{ llamada.horaFin }}</td>
                <td>{{ llamada.duracion }}</td>
                <td v-html="highlightMatches(llamada.nombre)"></td>
                <td v-html="highlightMatches(llamada.lengua)"></td>
                <td v-html="highlightMatches(llamada.categoria)"></td>
            </tr>
        </tbody>
    </v-table>
</template>
  
<script>
import axios from 'axios';

export default {
    methods: {
        highlightMatches(text) {
            const matchExists = text
                .toLowerCase()
                .includes(this.filter.toLowerCase());
            if (!matchExists) return text;

            const re = new RegExp(this.filter, "ig");
            return text.replace(re, matchedText => `<strong>${matchedText}</strong>`);
        }
    },
    computed: {
        filteredRows() {
            var variable =  this.llamadas.filter(llamada => {
                const sede = llamada.sede.toLowerCase();
                const nombre = llamada.nombre.toLowerCase();
                const lengua = llamada.lengua.toLowerCase();
                const categoria = llamada.categoria.toLowerCase();
                const searchTerm = this.filter.toLowerCase();

                return (
                    nombre.includes(searchTerm) || 
                    sede.includes(searchTerm) ||
                    lengua.includes(searchTerm) ||
                    categoria.includes(searchTerm)

                );
            
            });
            return variable;
        }
    },
    data() {
        return {
            filter: "",
            llamadas: [],

        };
    },
    async created() {
        try {
            const response = await axios.get('https://dennis.mindsoftdev.com/api/us');
            this.llamadas = response.data;
        } catch (error) {
            console.error(error);
        }
    }
};
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #dddddd;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 25px;
}
</style>