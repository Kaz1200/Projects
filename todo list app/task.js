import React from 'react';
import { Text, View, StyleSheet, TouchableOpacity, props} from 'react-native';

const Task = (props) => {
  return (
    <View style={styles.item}>
      <View style={styles.itemLeft}>
        <TouchableOpacity style={styles.square}></TouchableOpacity>
        <Text style={styles.itemText}>{props.text}</Text>
      </View>
      <View style={styles.circular}></View>
    </View>
  );
};

const styles = StyleSheet.create({
  item: {
    backgroundColor: '#C715F85',
    padding: 15,
    borderRadius: 10,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginTop: 20,
    borderStyle: 'dashed',
    borderWidth: 3,
    borderColor: '#A9A9A9'
  },
  itemLeft: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  square: {
    width: 20,
    height: 20,
    backgroundColor: '#90ee90',
    borderRadius: 10,
    marginRight: 15,
  },
  itemText: {
    maxWidth: '80%',
  },
 
});

export default Task;
