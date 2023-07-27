import React, {useState} from 'react';
import { KeyboardAvoidingView, StyleSheet, Text, View, TextInput, TouchableOpacity, Keyboard, ScrollView,Platform,CheckBox,ImageBackground } from 'react-native';
import Task from './components/Task';

export default function App() {
  const [task, setTask] = useState();
  const [taskItems, setTaskItems] = useState([]);
  const image = { uri:"https://wallpaperaccess.com/full/693652.jpg" };
  const handleAddTask = () => {
    Keyboard.dismiss();
    setTaskItems([...taskItems, task]) 
    setTask(null);
  }

  const completeTask = (index) => {
    let itemsCopy = [...taskItems];
    itemsCopy.splice(index, 1);
    setTaskItems(itemsCopy)
  }

  return (
    <View style={styles.container}>
    <ImageBackground
     source={image} style={styles.Logos}>
           
      <ScrollView
        contentContainerStyle={{
          flexGrow: 1
        }}
        keyboardShouldPersistTaps='handled'
      >
<Text style={styles.sectionTitle}>    Todo List</Text>
     
      <View style={styles.tasksWrapper}>
        <View style={styles.items}>
          {/* This is where the tasks will go! */}
          {
            taskItems.map((item, index) => {
              return (
                <TouchableOpacity key={index}  onPress={() => completeTask(index)}>
                  <Task text={item} /> 
                </TouchableOpacity>
              )
            })
          }
        </View>
      </View>
        
      </ScrollView>

      <KeyboardAvoidingView 
        behavior={Platform.OS === "ios" ? "padding" : "height"}
        style={styles.writeTaskWrapper}
      >
        <TextInput style={styles.input} placeholder={'Write task here.'} value={task} onChangeText={text => setTask(text)}placeholderTextColor="#ADFF2F" />
        <TouchableOpacity onPress={() => handleAddTask()}>
          <View style={styles.addWrapper}>
            <Text style={styles.addText}>🔴</Text>
          </View>
        </TouchableOpacity>
      </KeyboardAvoidingView>
      </ImageBackground>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flexDirection: "column",
    flex: 1,
    backgroundColor: '#9932CC',
  },
  tasksWrapper: {
    paddingTop: 10,
    paddingHorizontal: 10,
  },
  sectionTitle: {
    fontSize: 50,
    color:"#E0FFFF",
    fontWeight: "bold"

  },
  items: {
    marginTop: 30,
  },
  writeTaskWrapper: {
    position: 'absolute',
    bottom: 40,
    width: '100%',
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center'
  },
  input: {
    paddingVertical: 20,
    paddingHorizontal: 20,
    backgroundColor: '#C715F85',
    borderRadius: 20,
    borderColor: '#FFFFFF',
    borderWidth: 5,
    width: 230,
   borderStyle: 'dashed',
      

  },
  addWrapper: {
    width: 45,
    height: 45,
    backgroundColor: '#FFF',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
    borderColor: '#FFF',
    borderWidth: 1,
   
  },
  Logos: {
    resizeMode:"cover",
    flex:1,
    justifyContent: 'center',
  },
  addText: {},
});

