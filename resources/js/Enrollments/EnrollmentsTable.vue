<template>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    <div>
                        <label for="sort">Сортировка:</label>
                        <select class="form-select" id="sort" v-model="sort" @change="fetchData">
                            <option value="updated_at">По дате завершения</option>
                            <option value="created_at">По дате записи</option>
                            <option value="alphabetical">По алфавиту</option>
                        </select>
                    </div>
                </th>
                <th>
                    <div>
                        <label for="courseFilter">Фильтр по курсу:</label>
                        <input id="courseFilter" v-model="courseFilter" @input="fetchData" />
                    </div>
                </th>
                <th>
                    <div>
                        <label for="studentFilter">Фильтр по пользователю:</label>
                        <input id="studentFilter" v-model="studentFilter" @input="fetchData" />
                    </div>
                </th>
                <th>
                    <div>
                        <label for="statusFilter">Фильтр по статусу:</label>
                        <select id="statusFilter" v-model="statusFilter" @change="fetchData">
                            <option value="">Все</option>
                            <option value="0">In progress</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                </th>
                <th colspan="2">
                    <button @click="fetchData" class="btn btn-primary">Обновить данные</button>
                </th>
            </tr>
            <tr>
                <th></th>
                <th>Название курса</th>
                <th>Имя пользователя</th>
                <th>Результат</th>
                <th>Дата записи на курс</th>
                <th>Дата завершения курса</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="enrollment in enrollments" :key="enrollment.id">
                    <td></td>
                    <td>{{ enrollment.course_title }}</td>
                    <td>{{ enrollment.student_name }}</td>
                    <td><span :class="{ 'text-warning': enrollment.status == 'In Progress', 'text-success': enrollment.status == 'Completed' }">{{ enrollment.status }}</span></td>
                    <td>{{ enrollment.created_at }}</td>
                    <td>{{ enrollment.completed_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            enrollments: [],
            sort: 'updated_at',
            courseFilter: '',
            studentFilter: '',
            statusFilter: '',
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const params = new URLSearchParams({
                    sort_by: this.sort,
                    courseTitle: this.courseFilter,
                    studentName: this.studentFilter,
                    status: this.statusFilter,
                });

                const response = await fetch(`/api/enrollments?${params}`);
                const data = await response.json();
                this.enrollments = await data.enrollments;
            } catch (error) {
                console.error('Ошибка при получении данных:', error);
            }
        },
    },
};
</script>

<style scoped>
    table {
        margin-top: 50px;
    }
</style>
