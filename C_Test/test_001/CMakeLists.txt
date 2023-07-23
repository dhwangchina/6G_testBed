#
#
# First Time run: 
# cmake -G "MinGW Makefiles" ../
# cd build
# make -j 2
#


cmake_minimum_required(VERSION 3.12)
set(CMAKE_C_COMPILER GCC)
set(CMAKE_CXX_COMPILER G++)
set(CMAKE_CXX_STANDARD 17)
set(CMAKE_CXX_STANDARD_REQUIRED ON)
set(CMAKE_CXX_EXTENSIONS OFF)

PROJECT(Test_001)

INCLUDE_DIRECTORIES(
	include
)

set(SRC
    source/test_001.cpp
	source/reverseInt.cpp
	source/linkedlist.cpp
	source/sort_Bubble.cpp
	source/sort_Select.cpp
	source/sort_quick.cpp
	source/test_cpp17.cpp
	source/test_cpp18.cpp
    )
    
ADD_EXECUTABLE(test_001 ${SRC})
