/*
 * linkedlist.hpp
 *
 *  Created on: 2021��11��9��
 *      Author: Administrator
 */

#ifndef TEST_001_LINKEDLIST_HPP_
#define TEST_001_LINKEDLIST_HPP_
#include <stdio.h>
#include <stdlib.h>

unsigned int linkedListMain(void);

struct LinkedListTestData
{
	unsigned int ulNo;
	struct LinkedListTestData* pNext;
};


#endif /* TEST_001_LINKEDLIST_HPP_ */
