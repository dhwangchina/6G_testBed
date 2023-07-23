/*
 * test_cpp18.hpp
 *
 */

#ifndef _TEST_CPP18_HPP_
#define _TEST_CPP18_HPP_
#include <cassert>
#include <cstring>
#include <assert.h>

class Vector
{
public:
	Vector(int s): elem{new double[s]},sz{s}{}
	double& operator[](int i){return elem[i];}
	int size(){return sz;}
private:
	double* elem;
	int sz;
};

struct Point{
	int x;
	int y;
};

enum class Color{red,blue,green};
enum class Traffic_light{green,yellow,red};

double read_and_sum(int s);

#endif /* _TEST_CPP18_HPP_ */
