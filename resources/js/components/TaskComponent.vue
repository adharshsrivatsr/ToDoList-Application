<template>
        <div>
            <b-table striped hover :items="items"  :fields="fields" />
            <!-- <table class='table'>
                <thead>
                        <tr>    
                            <th>A</th>  
                            <th>B</th>
                        </tr>
                </thead>

                <tr v-for='t in this.taskVal'>
                        <td v-for='x in t'> 
                            
                        </td>

                </tr>
                </table> -->

                {{ this.taskVal[0]}}
        </div>
    </template>

    <script>
    export default {

        data () {
        
        return {
            
            taskVal:[],
           
        
        fields: [
            'first_name', 'last_name','age'
        ],
                
          
          items: [
          { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
        }
    },

    mounted()
         {
            axios.get('/task').then(response=>this.taskVal=response.data);
            

       },

        // methods:
        // {
        //     rowClass(item,type)
        //     {
        //         if(!item) return 
        //         if(item.first_name === 'Jami') return 'table-success'
        //     }
        // }
    }
    </script> 

    <style>
    </style>