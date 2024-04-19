<template>
  <div>
    
    <h2>Todos</h2>
     <router-link to="/">Home</router-link>
    <addTodo
      @add-todo="addTodo"
    />
    <select v-model="filter">
        <option value="all">All</option>
        <option value="completed">Completed</option>
        <option value="not-completed">Not completed</option>
    </select>
    <hr>
    <Loader
    v-if="loading"
    />
      <TodoList
      
      v-else-if="filteredTodos.length"
       v-bind:todos="filteredTodos"
       @remove-todo="removeTodo"
      />
      <p v-else>No todos!</p>
  </div>
</template>

<script>
import TodoList from '@/components/todolist'
import addTodo from '@/components/addtodo'
import Loader from '@/components/loader'

export default {
  name: 'App',
  data(){
    return {
        todos:[],
        loading:true,
        filter:'all'
    }
  },
  components: {
    TodoList,
    addTodo,
    Loader
  },
  mounted(){
    fetch('https://jsonplaceholder.typicode.com/todos?_limit=3')
        .then(response => response.json())
        .then(json =>{
            setTimeout(()=>{
                this.todos=json
                this.loading=false
            },1000)
          
        })
  },
  computed:{
      filteredTodos(){
          let filter
          if(this.filter==='all'){
                return this.todos
          }
          if(this.filter==='completed'){
                return this.todos.filter(t=>t.completed)
          }
          if(this.filter==='not-completed'){
                return this.todos.filter(t=>!t.completed)
          }
          return filter
      }
  },
  methods:{
    removeTodo(id){
      this.todos = this.todos.filter(t=>t.id!==id)
    },
    addTodo(todo){
      this.todos.push(todo)
    },
  }
}
</script>