<template lang="">
	<div class="container">
		<div class="col-md-8 offset-2">
			<div class="input-group mb-3">
				<input type="text" list="suggestions" v-debounce:700ms="autocomplete" class="form-control" placeholder="/path/to/file"
					v-model="filePath">
				<datalist id="suggestions">
					<option v-for="(suggestion, index) in suggestions" :key="index" :value="suggestion"/>
				</datalist>
				<div class="input-group-append">
					<button class="input-group-text btn btn-primary" id="basic-addon2" @click="getFileLines(1, true)">View</button>
				</div>
			</div>
			<div v-show="Object.entries(fileLines).length">
				<table class="table table-bordered table-hover">
					<tr v-for="(line, index) in fileLines" :key="index">
						<th scope="row" class="bg-light">{{ index }}</th>
						<td>{{ line }}</td>
					</tr>
				</table>
				<div class="row">
					<button class="col-3" @click="getFileLines(1)"> |&lt; </button>
					<button class="col-3" @click="getFileLines(page - 1)"> &lt; </button>
					<button class="col-3" @click="getFileLines(page + 1)"> &gt; </button>
					<button class="col-3" @click="getFileLines(lastPage)"> &gt;| </button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import axios from 'axios'

	export default {
		props: {

		},
		data () {
			return {
				filePath: null,
				suggestions: [],
				fileLines: {},
				page: 0,
				lastPage: 0,
				perPage: 10,
			}
		},
		methods: {
			autocomplete () {
				if (this.filePath) {
					this.http().get('/api/navigator/auto-complete', { params: { file_path: this.filePath } })
					.then(res => this.suggestions = res.data)
					.catch(({ response }) => this.toast(response.data.message, 'error'))
				}
			},
			getFileLines(page, isViewBtnClick)
			{
				if (!this.filePath) {
					this.toast('please enter file path', 'error');
				}

				this.page = page;
				this.http().get('/api/navigator/file-lines', { 
						params: { file_path: this.filePath, page: this.page, perPage: this.perPage } 
					})
					.then(({data}) => {
						this.fileLines = data.data;
						this.lastPage = data.last_page;
						if(isViewBtnClick) this.toast('Content Lodaded', 'success')
					})
					.catch(({ response }) => this.toast(response.data.message, 'error'))
			},
		},
	}
</script>
<style>
tr {
    border-right: 1px solid black;
    border-left: 1px solid black;
}

tr th{
    border-right: 1px solid black;
    border-left: 1px solid black;
		text-align: center;
}
table
{
	border: 1px solid black;
}
</style>