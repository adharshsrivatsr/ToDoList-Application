<template>
    <div>
        <b-table selectable :items="items" :fields="fields" dark show-empty>
            <template slot='name' slot-scope="{item}">
                {{item.name}}
            </template>
            
            <template slot='status' slot-scope='{item}'>
                <div v-if="item.status == '0'">
                    <font color='red'>Incomplete</font>
                 </div>
                
                <div v-else>
                    <font color='green'>Complete</font>
                </div>      
            </template>

            <template slot='priority' slot-scope='{item}'>
                <li v-for='prio in item.priorities'> <!--:key='prio' -->
                    {{ prio.priority}} 
                </li>
            </template>
        </b-table>

        <div class="control">
            <button class="button is-primary" @click="addActivity">Add Activity</button>
            <div v-show='showInput'>
                Input form
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                priorities:[],
                showInput:0,

                fields:[
                    {
                        key:'name',
                        sortable:true
                    },
                   
                    {
                        key:'priority',
                        sortable:true
                    },
                    {
                        key:'status',
                        sortable:true
                    },
                    {
                        key:'created_at',
                        sortable:true
                    },
                    {
                        key:'updated_at',
                        sortable:true
                    }
                    
                ]
            }
        },
        created: function () {
            this.getTasks()
        },
        methods: {
            getTasks: function () {
                axios.get('/tasks')
                    .then(response => {
                        this.items = response.data
                
                    })

                
            },

            finished:function() {
                if(this.item.status="0")
                    this.complete=0
            },

            addActivity:function() {
               this.showInput= !this.showInput
            }
        }
    }
</script>
