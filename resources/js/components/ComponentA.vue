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
            <tr v-for="(llamada, index) in llamadas" :key="`llamada-${index}`">

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
            return this.llamadas.filter(llamada => {
                const nombre = llamada.nombre.toLowerCase();
                const searchTerm = this.filter.toLowerCase();

                return (
                    nombre.includes(searchTerm)
                );
            });
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